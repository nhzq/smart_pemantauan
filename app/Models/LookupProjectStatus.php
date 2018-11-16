<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupProjectStatus extends Model
{
    protected $table = 'lookup_project_statuses';

    protected $fillable = [
        'name'
    ];
}
