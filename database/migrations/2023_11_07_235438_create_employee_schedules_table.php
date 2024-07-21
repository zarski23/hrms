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
        Schema::connection('second_db')->create('employee_schedules', function (Blueprint $table) {
            $table->id();
            $table->string('start_date',30)->nullable();
            $table->string('cut_off_date',30)->nullable();
            $table->string('dtr_id',10)->comment('id from Employee Profile table');
            $table->integer('schedule_id')->unsigned()->comment('id from Working Schedule table');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_schedules');
    }
};
