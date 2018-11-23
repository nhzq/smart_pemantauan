<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectTeam extends Model
{
    protected $fillable = [
        'project_id',
        'lookup_project_team_id',
        'lookup_project_role_id',
        'name',
        'position',
        'department_id',
        'group',
        'unit',
        'total_meeting',
        'meeting_dates',
        'created_by',
        'updated_by',
        'active'
    ];

    public function role()
    {
        return $this->belongsTo('App\Models\LookupProjectTeam', 'lookup_project_role_id');
    }
}
