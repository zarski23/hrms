<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DesignationList extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'employment_types'; 


    protected $fillable = [
        'employment_type_id',
        'employment_type',
    ];

}
