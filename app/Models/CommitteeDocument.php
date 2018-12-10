<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommitteeDocument extends Model
{
    protected $fillable = [
        'project_id', 'category', 'file_name', 'original_name', 'mime_type', 'size'
    ];
}
