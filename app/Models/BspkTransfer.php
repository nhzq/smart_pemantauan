<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BspkTransfer extends Model
{
    protected $dates = [
        'approval_date', 'warrant_date'
    ];
    
    protected $fillable = [
        'approval_date',
        'approval_letter_ref_no',
        'warrant_no',
        'warrant_date',
        'from_project_id',
        'to_project_id',
        'transfer_amount',
        'purpose',
        'created_by',
        'updated_by',
        'active'
    ];

    public function fromProject()
    {
        return $this->belongsTo('App\Models\Project', 'from_project_id');
    }

    public function toProject()
    {
        return $this->belongsTo('App\Models\Project', 'to_project_id');
    }

    public function projects()
    {
        return $this->belongsToMany('App\Models\Project', 'bspk_project', 'bspk_transfer_id', 'project_id');
    }
}
