<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalProvision extends Model
{
    protected $fillable = [
        'provision_id',
        'extra_budget_from',
        'extra_budget',
        'created_by',
        'updated_by',
        'active'
    ];
}
