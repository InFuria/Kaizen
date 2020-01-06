<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Till extends Model
{
    use Notifiable;

    protected $table = 'till';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'branch_id', 'status', 'opening_cash', 'actual_cash', 'close_cash'
    ];

}
