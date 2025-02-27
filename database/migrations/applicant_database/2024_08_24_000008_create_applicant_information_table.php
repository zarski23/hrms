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
        Schema::connection('second_db')->create('applicant_information', function (Blueprint $table) {
            $table->integer('id', 10);
            $table->string('application_code', 100)->unique();
            $table->string('first_name', 100);
            $table->string('middle_name', 50)->nullable();
            $table->string('last_name', 50);
            $table->string('extension_name', 20)->nullable();
            $table->string('sex', 10)->nullable();
            $table->string('civil_status', 20)->nullable();
            $table->date('date_of_birth')->nullable();
            $table->integer('age')->nullable();
            $table->string('place_of_birth', 50)->nullable();
            $table->string('contact_number', 50)->nullable();
            $table->string('email', 150)->nullable();
            $table->string('barangay', 100)->nullable();
            $table->string('municipality', 100)->nullable();
            $table->string('province', 100)->nullable();   
            $table->string('religion', 50)->nullable();
            $table->string('eligibility', 50)->nullable();
            $table->string('disability', 50)->nullable();
            $table->string('ethnic_group', 50)->nullable();
            $table->string('beneficiary_4ps', 10)->nullable();
            $table->string('status', 30)->nullable();
            $table->string('remarks')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('applicant_information');
    }
};
