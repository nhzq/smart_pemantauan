<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    protected $dates = [
        'plan_meeting_dates', 'actual_meeting_dates'
    ];
    
    protected $fillable = [
        'project_id', 
        'lookup_project_team_id', 
        'meeting_agenda', 
        'plan_meeting_dates', 
        'actual_meeting_dates', 
        'file_name', 
        'original_name', 
        'mime_type', 
        'size', 
        'created_by', 
        'updated_by', 
        'active'
    ];
}
