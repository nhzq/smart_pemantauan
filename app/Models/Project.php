<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $dates = [
        'approval_date', 
        'minute_approval_date', 
        'approval_pwn_date', 
        'verification_date', 
        'actual_approval_date',
        'collection_open_date',
        'collection_close_date',
        'collection_meeting_date'
    ];
    
    protected $fillable = [
        'allocation_id',
        'lookup_budget_type_id', 
        'lookup_sub_budget_type_id', 
        'name', 
        'file_reference_no', 
        'initial_scope',
        'initial_concept',
        'initial_purpose', 
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

    public function allocation()
    {
        return $this->belongsTo('App\Models\Allocation', 'allocation_id');
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

    public function meetings()
    {
        return $this->hasMany('App\Models\Meeting');
    }

    public function committee_documents()
    {
        return $this->hasMany('App\Models\CommitteeDocument');
    }

    public function chart()
    {
        return $this->hasMany('App\Models\OrganizationChart');
    }

    public function interims()
    {
        return $this->hasMany('App\Models\Interim');
    }

    public function bond()
    {
        return $this->hasOne('App\Models\Bond');
    }

    public function eots()
    {
        return $this->hasMany('App\Models\Eot');
    }

    public function lads()
    {
        return $this->hasMany('App\Models\Lad');
    }

    public function deliver()
    {
        return $this->hasOne('App\Models\Deliver');
    }

    public function schedules()
    {
        return $this->hasMany('App\Models\Gantt');
    }

    public function certificate()
    {
        return $this->hasOne('App\Models\Certificate');
    }

    /*
     * Reusable method
     */
    public function scopeGetLastRow($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
