<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkExperience extends Model
{
    use HasFactory;
    
    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'work_experience'; // Table name

    protected $fillable = [
        'applicant_id', 'from_date', 'to_date', 'position',
        'agency', 'salary', 'salary_grade', 'status', 'government_service'
    ];
}
