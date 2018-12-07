<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContractPayment extends Model
{
    protected $fillable = [
        'project_id', 'total_spending', 'balance', 'status', 'created_by', 'updated_by', 'active'
    ];
}
