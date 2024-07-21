<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Signatories extends Model

{
    use HasFactory;

    protected $connection = 'second_db';
    protected $table = 'signatories_table'; 


    protected $fillable = [
        'document_form',
        'signatory_count',
        'complete_name',
        'position',
    ];

}
