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
        Schema::connection('second_db')->create('employee_salaries', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('id from users table');
            $table->string('salary_grade');
            $table->double('daily_salary');
            $table->double('overtime_pay')->nullable();
            $table->double('taxable');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_salaries');
    }
};
