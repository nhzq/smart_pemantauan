<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contractor extends Model
{
    protected $fillable = [
        'project_id', 'name', 'position', 'ic', 'email', 'tel', 'created_by', 'updated_by', 'active'
    ];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }
}
