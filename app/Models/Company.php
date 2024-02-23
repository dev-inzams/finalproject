<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $fillable = [
        'employee_id',
        'Company_name',
        'Company_email',
        'Company_address',
        'Company_phone',
        'Company_website',
        'Company_logo'
    ];
}
