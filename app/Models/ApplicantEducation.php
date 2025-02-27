<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantEducation extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'applicant_education'; 


    protected $fillable = [
        'application_code',
        'baccalaureate',
        'specialization',
        'awards',
        'post_grad',
    ];
}
