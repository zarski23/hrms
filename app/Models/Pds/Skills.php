<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skills extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'skills_distinctions_memberships'; // Table name

    protected $fillable = [
        'applicant_id', 'skills_hobbies', 'distinctions', 'memberships'
    ];
}
