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
        Schema::create('employee_information', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('id from users table');
            $table->string('age',5)->nullable();
            $table->string('gender',10)->nullable();
            $table->string('mobile_number',15)->nullable();
            $table->string('address')->nullable();
            $table->string('birth_date',50)->nullable();
            $table->string('marital_status',30)->nullable();
            $table->string('tin_number',20)->nullable();
            $table->string('philhealth_number',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee_information');
    }
};
