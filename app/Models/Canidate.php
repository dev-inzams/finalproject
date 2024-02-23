<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canidate extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'father_name',
        'mother_name',
        'date_of_birth',
        'blood_group',
        'Social_id',
        'Passport_id',
        'cell_no',
        'emergency_no',
        'linkedin',
        'facebook',
        'github',
        'portfolio_link',
        'image'
    ];
}
