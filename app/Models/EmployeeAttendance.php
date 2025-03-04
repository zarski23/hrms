<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeAttendance extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'employee_attendance'; 

    protected $fillable = [
        'dtr_id',
        'date',
        'week',
        'time_in',
        'break_out',
        'break_in',
        'time_out',
        'late',
        'days_worked',
        'status',
    ];
}
