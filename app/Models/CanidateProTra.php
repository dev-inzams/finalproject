<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanidateProTra extends Model
{
    use HasFactory;
    protected $fillable = [
        'canidate_id',
        'training_name',
        'institute',
        'end_date'
    ];
}
