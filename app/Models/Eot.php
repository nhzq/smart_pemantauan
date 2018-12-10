<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Eot extends Model
{
    protected $dates = [
        'extend_date'
    ];

    protected $fillable = [
        'project_id', 'extend_date', 'reason', 'action', 'created_by', 'updated_by', 'active'
    ];
}
