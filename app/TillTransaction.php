<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TillTransaction extends Model
{
    protected $table = 'till_transactions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'till_id', 'type_id', 'detail_id', 'cash_before_op', 'cash_after_op', 'user_id'
    ];
}
