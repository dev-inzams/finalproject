<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanidateJobexperience extends Model
{
    use HasFactory;
    protected $fillable = [
        'canidate_id',
        'company_name',
        'position',
        'start_date',
        'end_date'
    ];
}
