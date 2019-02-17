<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eot extends Model
{
    protected $dates = [
        'application_date', 'eot_approval_date', 'extension_date'
    ];

    protected $fillable = [
        'project_id',
        'application_date',
        'eot_approval_date',
        'extension_date',
        'clause',
        'remarks',
        'created_by', 
        'updated_by', 
        'active'
    ];
}
