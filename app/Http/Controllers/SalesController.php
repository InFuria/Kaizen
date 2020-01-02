<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Invoice;
use App\InvoiceDetail;
use App\Order;
use App\Product;
use App\Sales;
use App\Stock;
use App\Till;
use App\TillTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SalesController extends Controller
{
    public function index()
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController::index The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            $user = auth()->user();

            // Respuesta para cargar el stock y el precio por producto
            if(\request()->ajax()) {
                $id = \request()->input('id');
                $stock = Stock::where('product_id', $id)->where('branch_id', auth()->user()->branch_id)
                    ->join('products','stock.product_id','=','products.id')
                    ->select('stock.quantity', 'products.price')->first();

                return response()->json($stock);
            }

            // Busqueda de datos por usuario
            if ( \request()->input()){
                $client = User::where('ci', \request()->input('client'))->first();

                $branch = Branch::where('id', auth()->user()->branch_id)->first();

                // All the product available in the branch
                $branchProducts = Branch::with('products')->find(auth()->user()->branch_id);
                $products = $branchProducts->getRelation('products')->pluck('name', 'id');


                return view('sales.index', compact('client', 'user', 'branch', 'products'));
            }

            return view('sales.index', compact('user'));

        } catch (\Exception $e){
            Log::error('SalesController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function store(Request $request){

        try{
            /*if ($this->user){
                Log::warning('SalesController::store The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $data = $request->all();
            $client = json_decode($data['client']);
            $till = Till::where('id', session('till'))->first();

            DB::beginTransaction();

            // ============================= INVOICE CREATION ==================================
            $branch_id = Branch::where('id', auth()->user()->branch_id)->pluck('code')->first();
            $user_code = (integer) substr((string) auth()->user()->ci, -3);
            $previous_id = Invoice::whereRaw('id = (select max(id) from invoices)')->pluck('id')->first();

            if ($previous_id == null)
                $id = $branch_id . $user_code . 1;

            if ($previous_id != null && $previous_id > 0)
                $id = $previous_id + 1;


            $invoice = new Invoice();
            $invoice->id = $id;
            $invoice->payment_id = 1;
            $invoice->total = 0;
            $invoice->client_id = $client->id;
            $invoice->save();


            // ============================= INVOICE DETAIL ====================================

            $product_detail = $request->session('products')->all();
            $sum = 0;

            foreach ($product_detail['product'] as $item) {
                $detail = new InvoiceDetail();
                $detail->invoice_id = /*$invoice->id*/99999;
                $detail->product_id = $item->id;
                $detail->quantity = $item->quantity;
                $detail->sub_total = (integer) $item->quantity*(integer) $item->price;// modificar a sub total
                //$detail->save();

                $sum += $detail->sub_total;

                $actual_stock = Stock::where('product_id', $item->id)->where('branch_id', auth()->user()->branch_id)->first();
                $new_stock = (integer) $actual_stock->quantity - (integer) $item->quantity;

                if ((integer) $item->quantity > $actual_stock)
                    return redirect()->back()->with('error', 'La cantidad solicitada supera el stock disponible');

                $stock = Stock::find($actual_stock->id);
                $stock->quantity = $new_stock;
                $stock->save();
            }


            // ================================= ORDER =========================================

            $order = new Order();
            $order->invoice_id = $invoice->id;
            $order->status = 0;
            $order->save();


            // ================================= SALES =========================================

            $sales = new Sales();
            $sales->invoice_id = $invoice->id;
            $sales->client_id = auth()->user()->id;
            $sales->till_id = session('till');
            $sales->save();


            // ============================= TILL_TRANSACTION ==================================

            $inv_total = Invoice::where('id', $invoice->id)->update(['total' => $sum]);

            foreach (session('products') as $item) {
                $old_quantity = Stock::where('product_id', $item->id)->where('branch_id', auth()->user()->branch_id)->first();
                $update = Stock::find($old_quantity->id);
                $update->quantity = $old_quantity->quantity - $item->quantity;
                $update->save();
            }


            $till_transaction = new TillTransaction();
            $till_transaction->till_id = session('till');
            $till_transaction->type_id= 3;
            $till_transaction->detail_id = $sales->id;
            $till_transaction->cash_before_op = $till->actual_cash;
            $till_transaction->cash_after_op = $till->actual_cash + $invoice->total;
            $till_transaction->user_id = auth()->user()->id;
            $till_transaction->save();

            DB::commit();

            session(["products"=>[]]);

            return redirect()->back()->with('success', 'Se ha registrado la venta');

        } catch (\Exception $e){
            DB::rollBack();
            Log::error('SalesController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function addProduct(Request $request){
        $input = $request->all();
        $product = Product::find($input['product']);
        $quantity = Stock::where('product_id', $input['product'])->pluck('quantity');
        $product->quantity = $quantity[0];

        if ($product->quantity < $input['quantity']){
            return json_encode(['data' => 1]);
        }else {
            $product->quantity = $input['quantity'];

            /*$productSession = session()->put('product', []);*/
            if (session('products') != null){

                // Aca agregar validacion de cantidad

                $productSession = session('products');
                $productSession = session()->push('products', $product);
            }else{
                $productSession = session()->put('products', [$product]);
            }
            return json_encode(['data' => 2]);
        }
    }

    public function getProducts(){
        return json_encode(session('products'));
    }

    public function removeProduct(Request $request){
        $products = session('products');

        $clear_session = session()->pull('products', []);

        foreach ($products as $key => $item){
            if ($item->id == $request->id){
                unset($products[$key]);
            }
        }

        session()->put('products', $products);

        return json_encode(session('products'));
    }
}
