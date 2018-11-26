<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AllocationTransfer extends Model
{
    protected $dates = [
        'approval_date', 'warrant_date'
    ];

    protected $fillable = [
        'approval_date',
        'approval_letter_ref_no',
        'warrant_no',
        'warrant_date',
        'budget_type_id',
        'from_sub_type_id',
        'to_sub_type_id',
        'transfer_amount',
        'verify_transfer_amount',
        'purpose',
        'created_by',
        'updated_by',
        'active'
    ];

    public function allocations()
    {
        return $this->belongsToMany('App\Models\Allocation', 'transfer_allocation', 'transfer_id', 'allocation_id');
    }

    public function subsFrom()
    {
        return $this->belongsTo('App\Models\LookupSubBudgetType', 'from_sub_type_id');
    }

    public function subsTo()
    {
        return $this->belongsTo('App\Models\LookupSubBudgetType', 'to_sub_type_id');
    }

    public function documents()
    {
        return $this->hasMany('App\Models\TransferDocument');
    }
}
