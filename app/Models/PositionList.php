<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PositionList extends Model

{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'employee_positions'; 


    protected $fillable = [
        'position_id',
        'position_name',
    ];

}
