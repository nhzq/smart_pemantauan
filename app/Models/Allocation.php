<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $fillable = [
        'provision_id',
        'lookup_department_id', 
        'lookup_budget_type_id', 
        'lookup_sub_budget_type_id',
        'amount',
        'extra_budget',
        'extra_budget_from',
        'extra_budget_date', 
        'created_by',
        'updated_by',
        'active'
    ];

    /*
     * Relationship
     */
    public function department()
    {
        return $this->belongsTo('App\Models\LookupDepartment', 'lookup_department_id');
    }

    public function budget()
    {
        return $this->belongsTo('App\Models\LookupBudgetType', 'lookup_budget_type_id');
    }

    public function sub()
    {
        return $this->belongsTo('App\Models\LookupSubBudgetType', 'lookup_sub_budget_type_id');
    }

    public function transfers()
    {
        return $this->belongsToMany('App\Models\AllocationTransfer', 'transfer_allocation', 'allocation_id', 'transfer_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project');
    }

    public function additionals()
    {
        return $this->hasMany('App\Models\AdditionalAllocation', 'allocation_id');
    }
}
