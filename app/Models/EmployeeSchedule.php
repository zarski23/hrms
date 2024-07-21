<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSchedule extends Model
{
    use HasFactory;

    protected $connection = 'second_db';

    protected $fillable = [
        'cut_off_date',
        'dtr_id',
        'schedule_id',
    ];

}
