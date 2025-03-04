<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Civil_service_eligibility extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'civil_service_eligibility'; // Table name

    protected $fillable = [
        'applicant_id', 'eligibility_type', 'rating', 
        'exam_date', 'exam_place', 'license_number', 'validity_date'
    ];
}