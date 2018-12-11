<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gantt extends Model
{
    protected $dates = [
        'start_date', 'end_date'
    ];

    protected $fillable = [
        'project_id', 'parent_id', 'activity', 'start_date', 'end_date', 'created_by', 'updated_by', 'active'
    ];
}
