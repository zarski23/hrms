<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Additional extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'additional_questions'; // Table name

    protected $fillable = [
        'applicant_id', 'question_1', 'question_2', 'question_3'
    ];
}
