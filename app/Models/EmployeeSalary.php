<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    
    protected $fillable = [
        'user_id',
        'salary_grade',
        'daily_salary',
        'overtime_pay',
        'taxable',
    ];
}
