<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    protected $fillable = [
        'lookup_department_id', 
        'lookup_budget_type_id', 
        'lookup_sub_budget_type_id',
        'amount', 
        'estimate_cost', 
        'project_cost', 
        'total_spending', 
        'balance'
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
}
