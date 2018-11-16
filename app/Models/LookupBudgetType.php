<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LookupBudgetType extends Model
{
     protected $fillable = [
        'lookup_department_id' ,'code', 'description'
    ];

    /*
     * Relationship
     */
    public function subs()
    {
        return $this->hasMany('App\Models\LookupSubBudgetType');
    }
}
