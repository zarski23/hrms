<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class app_access extends Model
{
    use HasFactory;

    protected $table = 'app_access'; // database table name

    protected $fillable = [
        'user_id',
        'app_id',
    ];
}
