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
        Schema::connection('second_db')->create('applicant_files', function (Blueprint $table) {
            $table->bigInteger('id',20);
            $table->integer('applicants_id')->unsigned()->comment('id from applicant information');
            $table->string('file_name',150)->nullable();
            $table->string('description')->nullable();
            $table->binary('file')->nullable();  // binary for BLOB storage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('applicant_files');
    }
};
