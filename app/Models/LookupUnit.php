<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupUnit extends Model
{
    protected $table = 'lookup_units';

    protected $fillable = [
        'role_id', 'lookup_section_id', 'name', 'displayed_name'
    ];

    /*
     * Relationship
     */
    public function section()
    {
        return $this->belongsTo('App\Models\LookupSection', 'lookup_section_id');
    }
}
