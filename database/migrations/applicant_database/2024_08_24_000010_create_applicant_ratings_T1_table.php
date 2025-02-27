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
        Schema::connection('second_db')->create('applicant_ratings_T1', function (Blueprint $table) {
            $table->integer('id', 10);
            $table->string('application_code', 100)->unique();
            $table->string('education_details', 100)->nullable();
            $table->double('education_inc', 8, 3)->nullable();
            $table->double('education_points', 8, 3)->nullable();
            $table->string('training_details', 100)->nullable();
            $table->double('training_inc', 8, 3)->nullable();
            $table->double('training_points', 8, 3)->nullable();
            $table->string('experience_details', 100)->nullable();
            $table->double('experience_inc', 8, 3)->nullable();
            $table->double('experience_points', 8, 3)->nullable();
            $table->string('pbet_let_lept_details', 100)->nullable();
            $table->double('pbet_let_lept_rating', 8, 3)->nullable();
            $table->double('pbet_let_lept_points', 8, 3)->nullable();
            $table->string('ppst_coi_details', 100)->nullable();
            $table->double('ppst_coi_rating', 8, 3)->nullable();
            $table->double('ppst_coi_points', 8, 3)->nullable();
            $table->string('ppst_ncoi_details', 100)->nullable();
            $table->double('ppst_ncoi_rating', 8, 3)->nullable();
            $table->double('ppst_ncoi_points', 8, 3)->nullable();
            $table->double('total_points', 8, 3)->nullable();
            $table->string('remarks',50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('applicant_ratings_T1');
    }
};
