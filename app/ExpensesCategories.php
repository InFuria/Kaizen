<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExpensesCategories extends Model
{
    protected $table = 'expenses_categories';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'service_number'
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
