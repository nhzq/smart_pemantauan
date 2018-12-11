<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lad extends Model
{
    protected $fillable = [
        'project_id', 'total_days', 'total_fine', 'action', 'created_by', 'updated_by', 'active'
    ];
}
