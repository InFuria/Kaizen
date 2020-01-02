<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\StockRequest;
use App\Product;
use App\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StockController extends Controller
{

    public function charge(){
        try{
            /*if ($this->user){
                Log::warning('StockController::charge The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            /*// All the product available in the branch
            $branchProducts = Branch::with('products')->find(auth()->user()->branch_id);
            $products = $branchProducts->getRelation('products')->pluck('name', 'id');*/

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

            $branch = Branch::find(auth()->user()->branch_id);

            $stock = Stock::where('product_id', $data['product']);

            DB::beginTransaction();

            if ($stock->first() == null){
                $stock = new Stock();
                $stock->product_id = $data['product'];
                $stock->branch_id = auth()->user()->branch_id;
                $stock->quantity = $data['quantity'];
                $stock->save();

            }else {
                Stock::where('product_id', $data['product'])->where('branch_id', auth()->user()->branch_id)->update([
                    'quantity' => (integer)$stock->first()->quantity + (integer)$data['quantity']]);
            }

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
}
