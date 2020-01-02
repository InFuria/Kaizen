<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'payment_id', 'client_id', 'total'
    ];

    public function sales (){
        return $this->belongsTo(Sales::class);
    }

    public function order (){
        return $this->hasOne(Order::class);
    }

    public function invoiceDetail (){
        return $this->hasMany(InvoiceDetail::class);
    }
}
