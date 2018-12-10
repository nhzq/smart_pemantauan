<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bond extends Model
{
    protected $fillable = [
        'project_id', 'guarantee_money', 'total_payment', 'created_by', 'updated_by', 'active'
    ];
}
