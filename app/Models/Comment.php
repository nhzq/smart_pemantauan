<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'project_id', 'content', 'created_by'
    ];

    /*
     * Relationships
     */
    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'project_id');
    }

    /*
     * Reusable method
     */
}
