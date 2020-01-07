<?php

namespace App\Services;

use Illuminate\Http\Request;

class ReportsService
{
    public static function daily($input){
        try{
            /*if ($this->user){
                Log::warning('Controller:: The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/



        } catch (\Exception $e){
            Log::error('ReportsService::daily ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }
}
