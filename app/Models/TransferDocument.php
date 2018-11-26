<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransferDocument extends Model
{
    protected $fillable = [
        'allocation_transfer_id', 'category', 'file_name', 'original_name', 'mime_type', 'size'
    ];
}
