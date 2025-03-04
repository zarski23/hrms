<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PdfFile extends Model
{
    use HasFactory;
    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'pdf_files'; // Table name

    protected $fillable = [
        'applicant_id', 'pdf_file', 'appointment_file'
    ];
}
