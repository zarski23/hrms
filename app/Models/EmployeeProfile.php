<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeProfile extends Model
{
    use HasFactory;

    protected $connection = 'second_db';

    
    protected $fillable = [
        'user_id',
        'dtr_id',
        'position_id',
        'department_id',
        'employment_type_id',
    ];
}
