<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\StockHistoryRequest;
use App\Http\Requests\StockRequest;
use App\Product;
use App\Stock;
use App\StockHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{

    public function index(){
        try{
            /*if ($this->user){
                Log::warning('StockController::index The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            if (session('till') === null && auth()->user()->ci != 7424196)
                return redirect()->back()->with('error', 'Seleccione la caja a operar para ver las posibles transacciones');

            $stock = Stock::where('quantity', '>', 0)->where('branch_id', auth()->user()->branch_id)
                ->join('products', 'stock.product_id', '=', 'products.id')->get();

            $branch = Branch::find(auth()->user()->branch_id)->name;

            return view('stock.index', compact('stock', 'branch'));

        } catch (\Exception $e){
            Log::danger('StockController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }

    public function charge(){
        try{
            /*if ($this->user){
                Log::warning('StockController::charge The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            /*// All the product available in the branch
            $branchProducts = Branch::with('products')->find(auth()->user()->branch_id);
            $products = $branchProducts->getRelation('products')->pluck('name', 'id');*/

            if (session('till') === null && auth()->user()->ci != 7424196)
                return redirect()->back()->with('error', 'Seleccione la caja a operar para ver las posibles transacciones');

            $products = Product::all()->pluck('name', 'id');

            return view('stock.charge_stock', compact('products'));

        } catch (\Exception $e){
            Log::error('StockController::change ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }

    public function store(StockRequest $request){
        try{
            /*if ($this->user){
                Log::warning('StockController::store The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $data = $request->all();
            $old_quantity = null;
            $new_quantity = null;

            $branch = Branch::find(auth()->user()->branch_id);

            $stock = Stock::where('product_id', $data['product'])->where('branch_id', auth()->user()->branch_id);

            DB::beginTransaction();

            $stock_history = new StockHistory();

            if ($stock->first() == null){
                $stock = new Stock();
                $stock->product_id = $data['product'];
                $stock->branch_id = auth()->user()->branch_id;
                $stock->quantity = $data['quantity'];
                $stock->save();

                $old_quantity = 0;
                $new_quantity = $stock->quantity;
                $stock_history->stock_id = $stock->id;

            }else {

                $old_quantity = $stock->first()->quantity;

                $update = $stock->update(['quantity' => (integer)$stock->first()->quantity + (integer)$data['quantity']]);

                $new_quantity = $stock->first()->quantity;

                $stock_history->stock_id = $stock->first()->id;
            }


            $stock_history->product_id = $data['product'];
            $stock_history->type = 'charge';
            $stock_history->old_quantity = $old_quantity;
            $stock_history->new_quantity = $new_quantity;
            $stock_history->ext_trans = 0;
            $stock_history->user_id = auth()->user()->id;
            $stock_history->save();

            DB::commit();

            /*if ($stock == null){
                $branch->products()->sync([$data['product'] => ['quantity' => $data['quantity'], 'created_at' => now(), 'updated_at' => now()]]);
            }else {
                $branch->products()->sync([$data['product'] => ['quantity' => $data['quantity'], 'updated_at' => now()]]);
            }*/

            return redirect()->back()->with('success', 'Se ha actualizado el stock!');

        } catch (\Exception $e){
            DB::rollBack();
            Log::error('StockController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }

    public function adjustment(){
        try{
            /*if ($this->user){
                Log::warning('StockController::adjustment The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            if (session('till') === null && auth()->user()->ci != 7424196)
                return redirect()->back()->with('error', 'Seleccione la caja a operar para ver las posibles transacciones');

            $products = Stock::where('quantity', '>', 0)->where('branch_id', auth()->user()->branch_id)
                ->join('products', 'stock.product_id', '=', 'products.id')->pluck('products.name', 'products.id');

            return view('stock.adjustment', compact('products'));

        } catch (\Exception $e){
            Log::error('StockController::adjustment ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }

    public function discount(StockHistoryRequest $request){
        try{
            /*if ($this->user){
                Log::warning('StockController::discount The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $data = $request->all();
            $old_quantity = null;
            $new_quantity = null;

            $branch = Branch::find(auth()->user()->branch_id);

            $stock = Stock::where('product_id', $data['product'])->where('branch_id', auth()->user()->branch_id);

            DB::beginTransaction();

            if ($stock->first() == null){

                return redirect()->back()->with('error', 'No se ha encontrado el producto');

            }else {

                $old_quantity = $stock->first()->quantity;

                $update = $stock->update(['quantity' => (integer)$stock->first()->quantity - (integer)$data['quantity']]);

                $new_quantity = $stock->first()->quantity;
            }

            $stock_history = new StockHistory();
            $stock_history->stock_id = $stock->first()->id;
            $stock_history->product_id = $data['product'];
            $stock_history->type = 'discount';
            $stock_history->old_quantity = $old_quantity;
            $stock_history->new_quantity = $new_quantity;
            $stock_history->ext_trans = 0;
            $stock_history->user_id = auth()->user()->id;
            $stock_history->save();

            DB::commit();

            return redirect()->back()->with('success', 'Se ha actualizado el stock!');

        } catch (\Exception $e){
            Log::error('StockController::discount ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }
}
