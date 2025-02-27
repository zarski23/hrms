<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantRating extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'applicant_ratings_T1'; 


    protected $fillable = [
        'application_code',
        'education_details',
        'education_inc',
        'education_points',
    ];
}
