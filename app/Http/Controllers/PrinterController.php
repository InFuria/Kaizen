<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\Log;

class PrinterController extends Controller
{
    public function printPDF($invoice, $products, $branch, $change){

        try{

            // This  $data array will be passed to our PDF blade
            $data = [
                'invoice' => $invoice,
                'product_detail' => $products,
                'branch' =>  $branch,
                'change' => $change
            ];

            $pdf = PDF::loadView('ticket.comprobante', $data);
            $filename = 'ticket_' . date("Y-m-d H:i:s") . '.pdf';
            return $pdf->download($filename);

        } catch (\Exception $e){
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        }

    }
}
