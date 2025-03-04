<?php

namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    use HasFactory;
    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'references'; // Table name

    protected $fillable = [
        'applicant_id', 'reference_name', 'reference_address', 'contact_no'
    ];
}
