<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('applications', function (Blueprint $table) {
            $table->integer('id', 10);
            $table->string('application_name');
            $table->timestamps();  
        });

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

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('applications');
    }
};
