<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    protected $dates = [
        'agreement_date', 'puu_review_date', 'puu_receive_date'
    ];

    protected $fillable = [
        'title', 'cost', 'agreement_date', 'puu_review_date', 'puu_receive_date', 'created_by', 'updated_by', 'active'
    ];
}
