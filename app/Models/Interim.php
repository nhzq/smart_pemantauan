<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interim extends Model
{
    protected $dates = [
        'payment_date'
    ];

    protected $fillable = [
        'project_id', 'payment_type', 'payment_no', 'payment_date', 'amount', 'description', 'created_by', 'updated_by', 'active'
    ];
}
