<?php
namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Children extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'children'; // Table name

    protected $fillable = [
        'applicant_id', 'child_name', 'child_birthdate'
    ];
}

