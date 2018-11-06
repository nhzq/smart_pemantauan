<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'project_id', 'content', 'created_by', 'status'
    ];

    /*
     * Relationships
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    public function createdByUser()
    {
        return $this->belongsTo('App\Models\User', 'status');
    }

    /*
     * Reusable method
     */
}
