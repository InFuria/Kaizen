<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SalesController extends Controller
{
    public function index()
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('sales.index');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }


    public function create()
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function store(Request $request)
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function show($id)
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function edit($id)
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function update(Request $request, $id)
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function destroy($id)
    {
        try{
            if (auth()->user()->isRole('cashier')){
                Log::warning('SalesController:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }

            return view('');

        } catch (\Exception $e){
            Log::danger('SalesController:: ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }
}
