<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicantInformation extends Model
{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'applicant_information'; 


    protected $fillable = [
        'first_name',
        'middle_name',
        'last_name',
        'extension_name',
        'sex',
        'civil_status',
        'date_of_birth',
        'age',
        'place_of_birth',
        'contact_number',
        'email',
        'barangay',
        'municipality',
        'province',
        'religion',
        'eligibility',
        'disability',
        'ethnic_group',
        'beneficiary_4ps',
        'status',
    ];
}
