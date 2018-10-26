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
        'name', 'email', 'password', 'username', 'lookup_department_id'
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

    /*
     * Reusable function
     */
}
