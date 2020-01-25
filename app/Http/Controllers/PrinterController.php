<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Illuminate\Support\Facades\Log;


class PrinterController extends Controller
{
    public function printPDF($invoice, $products, $branch, $change, $order){

        try{

           $data = [
                'invoice' => $invoice,
                'product_detail' => $products,
                'branch' =>  $branch,
                'change' => $change,
                'order' => $order
            ];

            $invoice = PDF::loadView('ticket.invoice', $data)->setPaper([20, 0, 272, 1154], 'portrait');
            return $invoice->stream('test.pdf');

            /*$viewhtml = \View::make('ticket.invoice', $data)->render();

            $dompdf = new Dompdf();
            $dompdf->loadHtml($viewhtml);
            $dompdf->setPaper([20, 0, 272, 1154], 'portrait');
            $dompdf->setBasePath('/../invoices/');
            $dompdf->render();
            $dompdf->stream();*/



        } catch (\Exception $e){
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        } catch (\Throwable $e) {
            Log::error('PrinterController::pdf ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error al imprimir el ticket.');
        }

    }
}
