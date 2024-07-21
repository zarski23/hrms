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
        Schema::connection('second_db')->create('employee_attendance', function (Blueprint $table) {
            $table->id();
            $table->string('dtr_id',10)->nullable();
            $table->string('date',30)->nullable();
            $table->string('week',30)->nullable();
            $table->string('time_in',20)->nullable();
            $table->string('break_out',20)->nullable();
            $table->string('break_in',20)->nullable();
            $table->string('time_out',20)->nullable();
            $table->integer('late')->nullable()->unsigned();
            $table->double('days_worked')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_attendance');
    }
};
