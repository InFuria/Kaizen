<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockHistory extends Model
{
    protected $table = 'stock_history';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'stock_id', 'product_id', 'type', 'old_quantity', 'new_quantity', 'user_id', 'ext_trans'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        '',
    ];
}
