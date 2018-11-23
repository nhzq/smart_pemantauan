<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupProjectTeam extends Model
{
    protected $fillable = [
        'team', 'parent_id', 'role'
    ];

    public function teams()
    {
        return $this->belongsToMany('App\Models\LookupProjectTeam', 'team_role', 'team_id', 'role_id');
    }
}
