<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupSection extends Model
{
    protected $table = 'lookup_sections';

    protected $fillable = [
        'role_id', 'name', 'displayed_name'
    ];

    /*
     * Relationship
     */
    public function units()
    {
        return $this->hasMany('App\Models\LookupUnit');
    }
}
