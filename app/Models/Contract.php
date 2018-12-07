<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $fillable = [
        'title', 'cost', 'aggreement_date', 'puu_review_date', 'puu_receive_date', 'created_by', 'updated_by', 'active'
    ];
}
