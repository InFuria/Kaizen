<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\TillRequest;
use App\Till;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class TillController extends Controller
{

    public function index(Request $request)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::index The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            $till = Till::where('branch_id', auth()->user()->branch_id)->get();
            $branch = Branch::where('id', auth()->user()->branch_id)->select('name')->first();

            $selectedTill = $till[0];

            if ($request->input('till')){
                $selectedTill = Till::where('id', $request->input('till'))->first();
                return view('till.index', compact('selectedTill', 'till', 'branch'));
            }

            return view('till.index', compact('till', 'branch', 'selectedTill'));

        } catch (\Exception $e){
            Log::error('TillController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function create()
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::create The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            return view('till.create');

        } catch (\Exception $e){
            Log::error('TillController::create ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function store(TillRequest $request)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::store The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/


            $till = Till::create([
                'branch_id' => $request->branch_id,
                'status' => 0,
                'opening_cash' => 0,
                'actual_cash' => 0,
                'close_cash' => 0,

            ]);

            return redirect()->back()->with('success', 'La caja se ha agregado correctamente.');

        } catch (\Exception $e){
            Log::error('TillController::store ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function status(TillRequest $request)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::status The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            if (Hash::check($request->password, auth()->user()->password)){

                $id = $request->id;

                $till = Till::find($id);
                $till->status = ! $till->status;
                $till->save();

                return redirect()->back()->with('success', 'El estado de la caja ' . $till->id . " se ha actualizado!");
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            Log::error('TillController::status ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function extract(Till $till)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::extract The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            $user = User::where('id', auth()->user()->id)->pluck('name', 'id');

            return view('till.extraction', compact('till', 'user'));

        } catch (\Exception $e){
            Log::error('TillController::extract ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function extraction(TillRequest $request, Till $till)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::extraction The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            if (Hash::check($request->password, auth()->user()->password)){

                $actual_cash = $till->actual_cash;

                $till->actual_cash = $actual_cash - $request->amount;
                $till->save();

                return redirect()->back()->with('success', 'El estado de la caja ' . $request->id . " se ha actualizado!");
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            Log::error('TillController::extraction ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function charge(Till $till)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::charge The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            $user = User::where('id', auth()->user()->id)->pluck('name', 'id');

            return view('till.deposit', compact('till', 'user'));
        } catch (\Exception $e){
            Log::error('TillController::charge ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function deposit(TillRequest $request, Till $till)
    {
        try{
            /*if (! auth()->user()->isRole('cashier')){
                \Log::warning('TillController::deposit The user ' . auth()->user()->name . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad.');
            }*/

            if (Hash::check($request->password, auth()->user()->password)){

                $actual_cash = $till->actual_cash;

                $till->actual_cash = $actual_cash + $request->amount;
                $till->save();

                return redirect()->back()->with('success', 'El estado de la caja ' . $request->id . " se ha actualizado!");
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            Log::error('TillController::deposit ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

}
