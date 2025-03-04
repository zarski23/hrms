<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantExperience extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'applicant_experience'; 


    protected $fillable = [
        'application_code',
        'details',
        'years',
        'remarks',
    ];
}
