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
        Schema::create('users', function (Blueprint $table) {
            $table->integer('id', 10);
            $table->string('username', 10)->unique();
            $table->string('image')->nullable();
            $table->string('first_name', 50);    
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50)->nullable();
            $table->string('password',60);
            $table->string('email')->unique()->nullable();
            $table->string('hr_user_role',30)->default('employee'); //default value is user
            $table->string('status', 20)->default('active'); //default value is status
            $table->string('date_hired',50);            
            $table->rememberToken();
            $table->timestamps();
        });

        DB::table('users')->insert([
            'username' => 'ADMIN-001',
            'image' => 'admin-image.png',
            'first_name' => 'System',
            'last_name' => 'Admin',
            'password' => sha1('admin1'), // Use SHA-1 hash function.
            'hr_user_role' => 'Super Admin',
            'status' => 'active',
            'date_hired' => now(), // Set the appropriate date here.            
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        
       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
