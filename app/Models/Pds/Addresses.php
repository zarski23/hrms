<?php
namespace App\Models\Pds;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    protected $connection = 'third_db'; // Connect to third_db

    protected $table = 'addresses'; // Table name

    protected $fillable = [
        'applicant_id', 'type', // Corrected 'type' → 'address_type'
        'house_no', 'street', 'subdivision',
        'barangay', 'city', 'province', 'zip_code' // Corrected 'zip_code' → 'zip'
    ];
}
