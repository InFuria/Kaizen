<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expenses extends Model
{
    protected $table = 'expenses';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'cost', 'expenses_category', 'branch_id'
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
