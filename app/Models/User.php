<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    use SoftDeletes;

    protected $fillable = [
        'name', 'ic', 'password', 'lookup_department_id', 'lookup_section_id', 'lookup_unit_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $dates = ['deleted_at'];

    /*
     * Relationships
     */
    public function department()
    {
        return $this->belongsTo('App\Models\LookupDepartment', 'lookup_department_id');
    }

    public function section()
    {
        return $this->belongsTo('App\Models\LookupSection', 'lookup_section_id');
    }

    public function unit()
    {
        return $this->belongsTo('App\Models\LookupUnit', 'lookup_unit_id');
    }

    public function appointedProject()
    {
        return $this->hasMany('App\Models\Project', 'appointed_to');
    }

    /*
     * Reusable method
     */
}
