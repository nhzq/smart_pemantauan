<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    protected $dates = [
        'start_date', 'end_date'
    ];

    protected $fillable = [
        'project_id', 
        'guarantee_money', 
        'total_payment', 
        'bond_value',
        'bank_name',
        'start_date',
        'end_date',
        'notes',
        'created_by', 
        'updated_by', 
        'active'
    ];
}
