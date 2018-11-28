<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model
{
    protected $fillable = [
        'project_id', 'committee_type_id', 'name', 'position', 'department'
    ];
}
