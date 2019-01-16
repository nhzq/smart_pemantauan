<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $dates = [
        'sst', 'ssm_start_date', 'ssm_end_date', 'mof_start_date', 'mof_end_date', 'contract_start_date', 'contract_end_date'
    ];
    
    protected $fillable = [
        'sst',
        'sst_reference_no',
        'contract_value',
        'ssm_no',
        'ssm_reference_no',
        'ssm_start_date',
        'ssm_end_date',
        'mof_no',
        'mof_reference_no',
        'mof_start_date',
        'mof_end_date',
        'company_name',
        'company_address',
        'company_email',
        'company_tel',
        'company_fax',
        'contract_start_date',
        'contract_end_date'
    ];
}
