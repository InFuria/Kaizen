<?php

namespace App\Http\Controllers;

use App\Expenses;
use App\ExpensesCategories;
use App\Http\Requests\ExpensesRequest;
use App\Till;
use App\TillTransaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ExpensesController extends Controller
{
    public function index (){
        try{
            /*if ($this->user){
                Log::warning('ExpensesController::index The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            if (session('till') === null && auth()->user()->ci != 7424196)
                return redirect()->back()->with('error', 'Seleccione la caja a operar para ver las posibles transacciones');

            $expenses = Expenses::where('branch_id', auth()->user()->branch_id)
                ->join('branches', 'expenses.branch_id', '=', 'branches.id')
                ->join('expenses_categories', 'expenses.expenses_category', '=', 'expenses_categories.id')
                ->selectRaw("expenses.description, expenses.cost, expenses.expenses_category, expenses.branch_id, branches.name as branch, expenses_categories.name as category")
                ->get();

            return view('expenses.index', compact('expenses'));

        } catch (\Exception $e){
            Log::error('ExpensesController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function create(){
        try{
            /*if ($this->user){
                Log::warning('ExpensesController::create The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $categories = ExpensesCategories::all()->pluck('name', 'id');

            return view('expenses.create', compact('categories'));

        } catch (\Exception $e){
            Log::error('ExpensesController::create ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function store(ExpensesRequest $request){
        try{
            /*if ($this->user){
                Log::warning('ExpensesController::store The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $till = Till::where('id', session('till'))->first();
            $old_cash= $till->actual_cash;

            $expense = new Expenses();
            $expense->description = $request->description;
            $expense->cost = $request->cost;
            $expense->expenses_category = $request->expenses_category;
            $expense->branch_id = auth()->user()->branch_id;
            $expense->save();

            $till->update(['actual_cash' => $till->actual_cash - $request->cost]);

            $register = new TillTransactionController();
            $register->registerTransaction(17, $expense->id, $old_cash, $till->actual_cash);

            return redirect()->back()->with('success', 'El gasto se ha registrado correctamente');

        } catch (\Exception $e){
            Log::error('ExpensesController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }
}
