<?php

namespace App\Http\Controllers;

use PDF;
use Illuminate\Support\Facades\Log;


class PrinterController extends Controller
{
    public function printPDF(/*$invoice, $products, $branch, $change*/){

        try{

            // This  $data array will be passed to our PDF blade
            /*$data = [
                'invoice' => $invoice,
                'product_detail' => $products,
                'branch' =>  $branch,
                'change' => $change
            ];

            return view('ticket.comprobante')
                ->with($invoice)->with($products)->with($branch)->with($change);// view('ticket.comprobante')->render();*/

            $data = ['title' => 'Welcome to HDTuto.com'];
            $pdf = PDF::loadView('ticket/comprobante', $data);

            return $pdf->download('itsolutionstuff.pdf');

        } catch (\Exception $e){
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        } catch (\Throwable $e) {
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        }

    }
}
