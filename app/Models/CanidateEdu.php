<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanidateEdu extends Model
{
    use HasFactory;
    protected $fillable = [
        'canidate_id',
        'degree',
        'institute',
        'passing_year',
        'department',
        'result'
    ];
}
