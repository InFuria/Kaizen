<?php

namespace App\Http\Controllers;

use App\TillTransaction;
use Illuminate\Http\Request;

class TillTransactionController extends Controller
{
    public function registerTransaction($type_id, $detail_id, $cash_before, $cash_after){
        $till_transaction = new TillTransaction();
        $till_transaction->till_id = session('till');
        $till_transaction->type_id= $type_id;
        $till_transaction->detail_id = $detail_id;
        $till_transaction->cash_before_op = $cash_before;
        $till_transaction->cash_after_op = $cash_after;
        $till_transaction->user_id = auth()->user()->id;
        $till_transaction->save();
    }
}
