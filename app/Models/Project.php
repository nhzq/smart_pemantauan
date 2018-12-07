<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = [
        'approval_date', 'minute_approval_date', 'approval_pwn_date', 'verification_date'
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
        'market_research',
        'objective',
        'minute_approval_date',
        'approval_pwn_date',
        'lookup_collection_type_id',
        'verified_by',
        'verification_date',
        'collection_file_no',
        'collection_open_date',
        'collection_close_date',
        'duration',
        'collection_meeting_date',
        'actual_approval_date',
        'actual_project_cost',
        'justification',
        'scope',
        'project_status',
        'status',
        'year',
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

    public function documents()
    {
        return $this->hasMany('App\Models\ProjectDocument');
    }

    public function committees_info()
    {
        return $this->hasMany('App\Models\CommitteeInformation');
    }

    public function committees()
    {
        return $this->hasMany('App\Models\Committee');
    }

    public function contractorAppointment()
    {
        return $this->hasOne('App\Models\Appointment');
    }

    public function contractors()
    {
        return $this->hasMany('App\Models\Contractor');
    }

    public function contract()
    {
        return $this->hasOne('App\Models\Contract');
    }

    public function teams()
    {
        return $this->hasMany('App\Models\ProjectTeam');
    }

    public function record()
    {
        return $this->hasOne('App\Models\Record');
    }

    public function payment()
    {
        return $this->hasOne('App\Models\ContractPayment');
    }

    /*
     * Reusable method
     */
    public function scopeGetLastRow($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
