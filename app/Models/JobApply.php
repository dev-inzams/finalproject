<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApply extends Model
{
    use HasFactory;

    protected $fillable = [
        'job_id',
        'company_id',
        'canidate_id',
        'description',
        'price',
        'status'
    ];
}
