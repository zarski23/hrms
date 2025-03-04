<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Family extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'family'; // Table name

    protected $fillable = [
        'applicant_id',
        'relation',
        'full_name',
        'occupation', 
        'employer', 
        'business_address', 
        'telephone_no'
    ];
}

