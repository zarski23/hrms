<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VolunteerWork extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'volunteer_work'; // Table name

    protected $fillable = [
        'applicant_id', 'organization_name', 'from_date', 'to_date',
        'hours_volunteered', 'position'
    ];
}
