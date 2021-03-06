<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupSubBudgetType extends Model
{
    protected $fillable = [
        'lookup_budget_type_id', 'code', 'description'
    ];

    /*
     * Relationship
     */
    public function budget()
    {
        return $this->belongsTo('App\Models\LookupBudgetType', 'lookup_budget_type_id');
    }

    public function projects()
    {
        return $this->hasMany('App\Models\Project', 'lookup_sub_budget_type_id');
    }
}
