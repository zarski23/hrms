<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CriteriaSPET extends Model
{
    use HasFactory;

    protected $connection = 'mysql';
    protected $table = 'criteria_spet'; 

    protected $fillable = [
        'criteria',
        'standard_points',
    ];
}
