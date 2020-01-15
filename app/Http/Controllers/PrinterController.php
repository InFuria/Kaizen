<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Barryvdh\Snappy\Facades\SnappyPdf as PDF;

class PrinterController extends Controller
{
    public function printPDF($invoice, $products, $branch, $change, $order){

        try{

            // This  $data array will be passed to our PDF blade
            $data = [
                'invoice' => $invoice,
                'product_detail' => $products,
                'branch' =>  $branch,
                'change' => $change,
                'order' => $order
            ];

            $pdf = PDF::loadView('ticket.comprobante', $data)->setOption('page-width', '76');

            $filename = base_path('storage/invoices/'.$invoice->id.'.pdf');
            $pdf->save($filename);
            

        } catch (\Exception $e){
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        } catch (\Throwable $e) {
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        }

    }
}
