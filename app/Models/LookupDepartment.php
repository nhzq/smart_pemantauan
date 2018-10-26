<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LookupDepartment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = [
        'code', 'name'
    ];

    /*
     * Relationships
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
