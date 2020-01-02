<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sales extends Model
{
    protected $table = 'sales';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'invoice_id', 'client_id', 'till_id'
    ];

    public function invoices(){
        return $this->hasOne(Invoice::class);
    }
}
