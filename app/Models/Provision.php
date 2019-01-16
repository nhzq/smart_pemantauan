<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Provision extends Model
{
    protected $dates = ['extra_budget_date'];
    
    protected $fillable = [
        'lookup_budget_type_id',
        'amount',
        'extra_budget',
        'extra_budget_from',
        'extra_budget_date',
        'created_by',
        'updated_by',
        'active'
    ];

    public function budgetType()
    {
        return $this->belongsTo('App\Models\LookupBudgetType', 'lookup_budget_type_id');
    }

    public function allocations()
    {
        return $this->hasMany('App\Models\Allocation');
    }

    public function additionals()
    {
        return $this->hasMany('App\Models\AdditionalProvision');
    }
}
