<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $fillable = [
        'project_id', 'record_type', 'authorized_officer', 'records_location', 'created_by', 'updated_by', 'active'
    ];
}
