<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('second_db')->create('employee_profiles', function (Blueprint $table) {
            // $table->id();
            $table->integer('user_id')->unsigned()->comment('id from users table');
            $table->string('dtr_id',10)->nullable();
            $table->string('position_id')->nullable();
            $table->string('department_id')->nullable();
            $table->string('employment_type_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_profiles');
    }
};
