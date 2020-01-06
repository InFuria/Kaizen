<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'order';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'status'
    ];

    public function invoice(){
        return $this->belongsTo(Invoice::class);
    }
}
