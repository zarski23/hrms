<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ApplicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('applications')->insert([
            ['application_name' => 'HRM System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Treasury Management System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Accounting Information System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Budgeting System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Supply Office Inventory Management System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Assessor’s System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Tourism Website', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Farmer Information Management System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'MDRRMO System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'MSWDO System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'RHU System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Barangay Information System', 'created_at' => now(), 'updated_at' => now()],
            ['application_name' => 'Sangguniang Bayan System', 'created_at' => now(), 'updated_at' => now()],   
        ]);

    }
}
