<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LookupJabatan extends Model
{
    use SoftDeletes;

    protected $table = 'lookup_jabatan';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'kod', 'nama'
    ];

    /*
     * Relationships
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
}
