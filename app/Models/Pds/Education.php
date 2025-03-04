<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class education extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'education'; // Table name

    protected $fillable = [
        'applicant_id', 'level', 'school_name', 'course',
        'year_graduated', 'units_earned', 'dates_attended', 'academic_honors'
    ];
}
