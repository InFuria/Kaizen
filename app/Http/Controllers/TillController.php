<?php

namespace App\Http\Controllers;

use App\Branch;
use App\Http\Requests\TillAuditRequest;
use App\Http\Requests\TillRequest;
use App\Till;
use App\TillAudit;
use App\TillTransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

            session(['till' => $selectedTill->id]);

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

            DB::beginTransaction();

            $till = Till::create([
                'branch_id' => $request->branch_id,
                'status' => 0,
                'opening_cash' => 0,
                'actual_cash' => 0,
            ]);

            $till_transaction = new TillTransaction();
            $till_transaction->till_id = $till->id;
            $till_transaction->type_id= 14;
            $till_transaction->detail_id = 0;
            $till_transaction->cash_before_op = 0;
            $till_transaction->cash_after_op = 0;
            $till_transaction->user_id = auth()->user()->id;
            $till_transaction->save();

            DB::commit();

            return redirect()->back()->with('success', 'La caja se ha agregado correctamente.');

        } catch (\Exception $e){
            DB::rollBack();
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

                DB::beginTransaction();

                $till = Till::find($id);
                $till_transaction = new TillTransaction();
                $till_transaction->type_id= 2;

                if ($till->status === true && ! session('audit')){
                    return redirect()->back()->with('error', 'Por favor realice un arqueo de caja antes de cerrar la misma');
                }

                if ($till->status === false){
                    $till->opening_cash = $request->op_cash;
                }

                $till->status = ! $till->status;
                $till->save();

                if ($till->status == 0) {
                    session()->forget('audit');
                    $till_transaction->type_id= 1;
                }

                $till_transaction->till_id = $till->id;
                $till_transaction->detail_id = 0;
                $till_transaction->cash_before_op = 0;
                $till_transaction->cash_after_op = 0;
                $till_transaction->user_id = auth()->user()->id;
                $till_transaction->save();

                DB::commit();

                return redirect()->back()->with('success', 'El estado de la caja ' . $till->id . " se ha actualizado!");
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            DB::rollBack();
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

                DB::beginTransaction();

                $actual_cash = $till->actual_cash;

                if ((integer)$request->amount > $actual_cash)
                    return redirect()->back()->with('error', 'El monto ingresado supera el saldo disponible.');

                $till->actual_cash = $actual_cash - $request->amount;
                $till->save();

                $till_transaction = new TillTransaction();
                $till_transaction->till_id = $till->id;
                $till_transaction->type_id= 1;
                $till_transaction->detail_id = 0;
                $till_transaction->cash_before_op = $actual_cash;
                $till_transaction->cash_after_op = $till->actual_cash;
                $till_transaction->user_id = auth()->user()->id;
                $till_transaction->save();

                DB::commit();

                return redirect()->back()->with('success', 'El estado de la caja ' . $request->id . " se ha actualizado!");
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            DB::rollBack();
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

                DB::beginTransaction();

                $actual_cash = $till->actual_cash;

                $till->actual_cash = $actual_cash + $request->amount;
                $till->save();

                $till_transaction = new TillTransaction();
                $till_transaction->till_id = $till->id;
                $till_transaction->type_id= 2;
                $till_transaction->detail_id = 0;
                $till_transaction->cash_before_op = $actual_cash;
                $till_transaction->cash_after_op = $till->actual_cash;
                $till_transaction->user_id = auth()->user()->id;
                $till_transaction->save();

                DB::commit();

                return redirect()->back()->with('success', 'El estado de la caja ' . $request->id . " se ha actualizado!");
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            DB::rollBack();
            Log::error('TillController::deposit ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }
    }

    public function cashCount(Till $till){
        try{
            /*if ($this->user){
                Log::warning('TillController::cashCount The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            return view('till.cash_count', compact('till'));

        } catch (\Exception $e){
            Log::error('TillController::cashCount ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }

    public function audit(TillAuditRequest $request, Till $till){
        try{
            /*if ($this->user){
                Log::warning('TillController::audit The user ' . $this->user . 'no has permission to access to this function ');
                return redirect()->back()->with('error', 'No posee permisos para utilziar esta funcionalidad, por favor contacte con Soporte.');
            }*/

            if (Hash::check($request->password, auth()->user()->password)){

                DB::beginTransaction();

                $declared_cash = (integer)$request->declared_cash;
                \Log::error($till->actual_cash);
                $status = null;

                if ($declared_cash === $till->actual_cash)
                    $status = 0; //normal

                if ($declared_cash < $till->actual_cash || $declared_cash === 0 && $till->actual_cash != 0)
                    $status = 1; //faltante

                if ($declared_cash > $till->actual_cash)
                    $status = 2; //sobrante


                $audit = TillAudit::create([
                    'till_id' => $till->id,
                    'user_id' => auth()->user()->id,
                    'registered_cash' => $till->actual_cash,
                    'declared_cash' => $declared_cash,
                    'status' => $status
                ]);

                $tillSession = session()->put('audit', [$till]);

                switch ($status){
                    case 0:
                        $message = 'El arqueo dio un resultado normal. Puede cerrar la caja.';
                        $status = 'Normal';
                        break;
                    case 1:
                        $message = 'El arqueo dio como resultado: faltante de dinero';
                        $status = 'Faltante';
                        break;
                    case 2:
                        $message = 'El arqueo dio como resultado: sobrante de dinero';
                        $status = 'Sobrante';
                        break;
                }

                $till_transaction = new TillTransaction();
                $till_transaction->till_id = $till->id;
                $till_transaction->type_id= 4;
                $till_transaction->detail_id = $audit->id;
                $till_transaction->cash_before_op = $till->actual_cash;
                $till_transaction->cash_after_op = $till->actual_cash;
                $till_transaction->user_id = auth()->user()->id;
                $till_transaction->save();

                DB::commit();

                return response()->json(['success' => $message, 'audit' => $audit, 'status' => $status]);
            }

            return redirect()->back()->with('error', 'Contraseña incorrecta');

        } catch (\Exception $e){
            DB::rollBack();
            Log::error('TillController::audit ' . $e->getMessage(), ['error_line' => $e->getLine()]);
            return redirect()->back()->with('error', 'Oops parece que ocurrio un error, por favor intente nuevamente.');
        }

    }

}
