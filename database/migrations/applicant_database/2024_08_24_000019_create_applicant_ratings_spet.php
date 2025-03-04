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
        Schema::connection('second_db')->create('applicant_ratings_spet', function (Blueprint $table) {
            $table->integer('id', 10);
            $table->string('application_code');
            $table->integer('criteria_id')->unsigned()->comment('id from criteria table');
            $table->string('criteria_details')->nullable();
            $table->double('criteria_increment', 8, 3)->nullable();
            $table->double('criteria_credits', 8, 3)->nullable();
            $table->double('criteria_points', 8, 3)->nullable();
            $table->string('remarks',150)->nullable();
            $table->integer('evaluator_id')->unsigned()->comment('id from user table');
            $table->integer('super_admin_id ')->unsigned()->comment('id from user table');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('applicant_ratings_spet');
    }
};
