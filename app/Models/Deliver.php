<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deliver extends Model
{
    protected $dates = [
        'deliverable_date', 'official_deliverable_date'
    ];

    protected $fillable = [
        'project_id',
        'officer_name',
        'position',
        'deliverable_date',
        'official_deliverable_date',
        'created_by',
        'updated_by',
        'active'
    ];
}
