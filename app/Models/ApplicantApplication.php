<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantApplication extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'application'; 


    protected $fillable = [
        'application_code',
        'application_title',
        'school_name',
        'school_barangay',
        'school_municipality',
    ];
}
