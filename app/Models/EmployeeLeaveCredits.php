<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeLeaveCredits extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'employee_leave_credits'; 
    
    protected $fillable = [
        'user_id',
        'dtr_id',
        'month',
        'year',
        'late_day',
        'late_hours',
        'late_minutes',
        'vacation_leave_earned',
        'vacation_leave_deduction',
        'vacation_leave_balance',
        'sick_leave_earned',
        'sick_leave_deduction',
        'sick_leave_balance',
    ];
}
