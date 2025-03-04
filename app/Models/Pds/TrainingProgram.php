<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingProgram extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'training_programs'; // Table name

    protected $fillable = [
        'applicant_id', 'title', 'from_date', 'to_date',
        'hours', 'type', 'sponsor'
    ];
}
