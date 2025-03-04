<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantTraining extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'applicant_training'; 


    protected $fillable = [
        'application_code',
        'title',
        'hours',
        'remarks',
    ];
}
