<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model {
    use HasFactory;
    protected $fillable = [
        'company_id',
        'category_id',
        'title',
        'description',
        'image',
        'skills',
        'type',
        'salary',
        'expire',
        'status'
    ];
}
