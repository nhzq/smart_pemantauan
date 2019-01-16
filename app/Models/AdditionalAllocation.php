<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdditionalAllocation extends Model
{
    protected $fillable = [
        'allocation_id',
        'extra_budget_from',
        'extra_budget',
        'created_by',
        'updated_by',
        'active'
    ];
}
