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
        Schema::connection('second_db')->create('working_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('shift_type',20)->nullable(); //description of the type of shift (Morning shift, Afternoon shift, Night shift).
            $table->string('start_day',20)->nullable();
            $table->string('end_day',20)->nullable();
            $table->string('start_time',20)->nullable();
            $table->string('break_out_time',20)->nullable();
            $table->string('break_in_time',20)->nullable();
            $table->string('end_time',20)->nullable();            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('working_schedules');
    }
};
