<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class InvoiceDetail extends Model
{
    protected $table = 'invoice_detail';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'product_id', 'quantity', 'sub_total'
    ];

    public function products(){
        return $this->belongsTo(Product::class);
    }

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
