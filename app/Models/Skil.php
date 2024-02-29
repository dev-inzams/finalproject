<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skil extends Model
{
    use HasFactory;
    protected $fillable = [
        'canidate_id',
        'name',
        'level',
    ];
}
