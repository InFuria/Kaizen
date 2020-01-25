<?php

namespace App\Http\Controllers;

use App\Branch;
use App\InvoiceDetail;
use App\Product;
use App\Sales;
use App\TillTransaction;
use Carbon\Carbon;
use DateTime;
use FontLib\Table\Type\kern;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

            $branches = Branch::all()->pluck('name', 'id');

            if ($input = \request()->input()){

                $start = $this->formatDate('start', $input['day']);
                $end = $this->formatDate('end', $input['day']);
                $day = $input['day'];
                $branches = Branch::where('id', $input['branch_id'])->pluck('name', 'id');

                $data = InvoiceDetail::whereRaw("invoice_detail.created_at BETWEEN '" . $start . "' AND '" . $end . "'")
                    ->whereRaw("users.branch_id = " . $input['branch_id'])
                    ->join('products', 'invoice_detail.product_id', '=', 'products.id')
                    ->join('sales', 'invoice_detail.invoice_id', '=', 'sales.invoice_id')
                    ->join('users', 'sales.user_id', '=', 'users.id')
                    ->join('invoices', 'invoice_detail.invoice_id', '=', 'invoices.id')
                    ->selectRaw("invoice_detail.id as detail_id, invoice_detail.invoice_id as invoice_id, invoices.total as total, product_id, products.name as product, quantity, sub_total,
                    slug, users.name, price, invoices.created_at as created")
                    ->orderBy("invoice_id", 'ASC')
                    ->get();

                $data = $data->toArray();
                $results[] = null;

                foreach ($data as $key => $item){

                    $results[$key] = $item;

                    $results[$key][] = array_filter($data, function ($value, $i) use ($results, $key, $item){
                        if ($value['invoice_id'] == $results[$key]['invoice_id'] && $value['detail_id'] != $results[$key]['detail_id']){
                            return $value;
                        }
                        return false;
                    }, ARRAY_FILTER_USE_BOTH);
                }

                foreach ($results as $k => $v){
                    if ($k > 0)
                    if ($results[$k]['invoice_id'] === $data[$k - 1]['invoice_id']){
                        unset($results[$k]);
                    }
                }

                $final = [];
                foreach ($results as $key => $item){
                    $final[] = $item; // Cada indice guarda una venta
                }

                return view('reports.daily', compact('final', 'branches', 'day'));
            }

            return view('reports.daily', compact('branches'));

        } catch (\Exception $e){
            Log::error('ReportsController::daily ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function dailyProducts(){
        try{
            /*if ($this->user){
                Log::warning('ReportsController::dailyProducts The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $branches = Branch::all()->pluck('name', 'id');

            if ($input = \request()->input()){

                $start = $this->formatDate('start', $input['day']);
                $end = $this->formatDate('end', $input['day']);
                $day = $input['day'];
                $branches = Branch::where('id', $input['branch_id'])->pluck('name', 'id');

                $data = InvoiceDetail::whereRaw("invoice_detail.created_at BETWEEN '" . $start . "' AND '" . $end . "'")
                    ->whereRaw("users.branch_id = " . $input['branch_id'])
                    ->join('products', 'invoice_detail.product_id', '=', 'products.id')
                    ->join('sales', 'invoice_detail.invoice_id', '=', 'sales.invoice_id')
                    ->join('users', 'sales.user_id', '=', 'users.id')
                    ->selectRaw("invoice_detail.product_id, products.name, products.slug, sum(invoice_detail.quantity) as quantity, sum(invoice_detail.sub_total) as sub")
                    ->groupBy('invoice_detail.product_id')
                    ->get();

                return view('reports.daily_products', compact('data', 'branches', 'day'));
            }

            return view('reports.daily_products', compact('branches'));

        } catch (\Exception $e){
            Log::error('ReportsController::dailyProducts ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function tillHistory(){
        try{
            /*if ($this->user){
                Log::warning('ReportsController::tillHistory The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilizar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            $branches = Branch::all()->pluck('name', 'id');

            if ($input = \request()->input()){

                $start = $this->formatDate('start', $input['start']);
                $end = $this->formatDate('end', $input['end']);

                $branches = Branch::where('id', $input['branch_id'])->pluck('name', 'id');

                $results = TillTransaction::whereRaw("till_transactions.created_at BETWEEN '" . $start . "' AND '" . $end . "'")
                    ->whereRaw("users.branch_id = " . $input['branch_id'])
                    ->whereRaw("till_transactions.type_id = 1 OR till_transactions.type_id = 2")
                    ->join('users', 'till_transactions.user_id', '=', 'users.id')
                    ->join('branches', 'users.branch_id', '=', 'branches.id')
                    ->selectRaw("till_transactions.till_id, till_transactions.type_id, till_transactions.cash_before_op, till_transactions.cash_after_op, users.name, till_transactions.created_at, branches.name as branch")
                    ->get();

                $start = $input['start'];
                $end = $input['end'];

                return view('reports.tillHistory', compact('results', 'branches', 'start', 'end'));
            }

            return view('reports.tillHistory', compact('branches'));

        } catch (\Exception $e){
            Log::error('ReportsController::tillHistory ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }


    public function formatDate($type, $date){

        switch ($type){
            case 'start':
                return DateTime::createFromFormat('d/m/Y', $date)->setTime(0, 0,0)->format('Y-m-d H:i:s');
            break;
            case 'end':
                return DateTime::createFromFormat('d/m/Y', $date)->setTime(23, 59,59)->format('Y-m-d H:i:s');
            break;
        }
    }
}
