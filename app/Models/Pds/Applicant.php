<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Applicant extends Model
{
    protected $connection = 'third_db';

    protected $table = 'applicants';

    use HasFactory;
    
    protected $fillable = [
        'first_name', 'middle_name', 'last_name', 'name_extension',
        'date_of_birth', 'place_of_birth', 'sex', 'civil_status',
        'citizenship', 'height_cm', 'weight_kg', 'blood_type',
        'mobile_no', 'telephone_no', 'email_address',
        'gsis_no', 'pagibig_no', 'philhealth_no', 'sss_no', 'tin_no',
        'agency_employee_no'
    ];
}
