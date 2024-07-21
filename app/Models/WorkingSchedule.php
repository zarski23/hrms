<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkingSchedule extends Model
{
    use HasFactory;

    protected $connection = 'second_db';

    protected $fillable = [
        'user_id',
        'shift_cutoff_date',
        'shift_type',
        'start_time',
        'break_out_time',
        'break_in_time',
        'end_time',
    ];

}
