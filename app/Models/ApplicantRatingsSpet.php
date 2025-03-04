<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantRatingsSpet extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'applicant_ratings_spet'; 


    protected $fillable = [
        'application_code',
        'criteria_id',
        'criteria_details',
        'criteria_increment',
        'criteria_credits',
        'criteria_points',
        'remarks',
        'evaluator_id',
        'super_admin_id',
    ];
}
