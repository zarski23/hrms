<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeInformation extends Model
{
    use HasFactory;

    protected $connection = 'mysql';

    protected $fillable = [
        'user_id',
        'age',
        'gender',
        'mobile_number',
        'address',
        'birth_date',
        'marital_status',
        'tin_number',
        'philhealth_number',
    ];
}
