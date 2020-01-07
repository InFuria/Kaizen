<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
{
    public function index(){
        try{
            /*if ($this->user){
                Log::warning('ReportsController::index The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            if (session('till') === null && auth()->user()->ci != 7424196)
                return redirect()->back()->with('error', 'Seleccione la caja a operar para ver las posibles transacciones');

            return view('reports.index');

        } catch (\Exception $e){
            Log::error('ReportsController::index ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function daily(){
        try{
            /*if ($this->user){
                Log::warning('ReportsController::daily The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad, por favor contacte con Soporte.');
            }*/



        } catch (\Exception $e){
            Log::error('ReportsController::daily ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }
}
