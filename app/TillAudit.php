<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TillAudit extends Model
{
    protected $table = 'till_audit';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'till_id', 'user_id', 'registered_cash', 'declared_cash', 'status'
    ];
}
