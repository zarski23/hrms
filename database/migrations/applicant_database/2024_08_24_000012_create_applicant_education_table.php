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
        Schema::connection('second_db')->create('applicant_education', function (Blueprint $table) {
            $table->bigInteger('id',20);
            $table->string('application_code', 100);
            $table->string('baccalaureate',150)->nullable();
            $table->string('specialization', 150)->nullable();
            $table->string('awards', 150)->nullable();
            $table->string('post_grad', 150)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('applicant_education');
    }
};
