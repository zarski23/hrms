<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentList extends Model
class DepartmentList extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'employee_departments'; 


    protected $fillable = [
        'department_id',
        'department_name',
    ];

}
