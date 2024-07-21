<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         // Insert the default admin user with a SHA-1 hashed password.
         DB::table('users')->insert([
            'employee_id' => 'ADMIN-001',
            'image' => 'admin-image.jpg',
            'first_name' => 'HR',
            'last_name' => 'Admin',
            'password' => sha1('admin1'), // Use SHA-1 hash function.
            'hr_user_role' => 'admin',
            'status' => 'active',
            'date_hired' => 'Wed, Oct 23, 2023', // Set the appropriate date here.            
            'created_at' => now(),
            'updated_at' => now(),
        ]);

    }
}
