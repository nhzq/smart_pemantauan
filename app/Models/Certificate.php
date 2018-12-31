<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    protected $dates = [
        'witness_date', 'contractor_date'
    ];

    protected $fillable = [
        'project_id',
        'definition',
        'details',
        'witness_date',
        'witness_officer_name',
        'witness_name',
        'witness_ic',
        'witness_address',
        'contractor_date',
        'contractor_name',
        'contractor_ic',
        'contractor_address',
        'created_by',
        'updated_by',
        'active'
    ];
}
