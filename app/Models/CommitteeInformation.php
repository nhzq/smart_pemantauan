<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeInformation extends Model
{
    protected $dates = [
        'appointment_date'
    ];
    
    protected $fillable = [
        'project_id', 'committee_type_id', 'appointment_date'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
}
