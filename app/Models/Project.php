<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $fillable = [
        'name', 'cost', 'total_amount', 'status', 'created_by', 'updated_by', 'description'
    ];

    /*
     * Relationship
     */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /*
     * Reusable method
     */
    public function scopeGetLastRow($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
