<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = [
        'approval_date', 'minute_approval_date', 'approval_pwn_date'
    ];
    
    protected $fillable = [
        'lookup_budget_type_id', 
        'lookup_sub_budget_type_id', 
        'name', 
        'file_reference_no', 
        'concept', 
        'estimate_cost', 
        'approval_date',
        'rmk',
        'proposal',
        'market_research',
        'market_research_file',
        'status',
        'active',
        'created_by',
        'updated_by'
    ];

    /*
     * Relationship
     */
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    public function budget()
    {
        return $this->belongsTo('App\Models\LookupBudgetType', 'lookup_budget_type_id');
    }

    public function sub()
    {
        return $this->belongsTo('App\Models\LookupSubBudgetType', 'lookup_sub_budget_type_id');
    }

    public function collection()
    {
        return $this->belongsTo('App\Models\LookupCollectionType', 'lookup_collection_type_id');
    }

    /*
     * Reusable method
     */
    public function scopeGetLastRow($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
