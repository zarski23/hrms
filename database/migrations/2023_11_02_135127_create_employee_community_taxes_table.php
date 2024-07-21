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
        Schema::connection('second_db')->create('employee_community_taxes', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->unsigned()->comment('id from users table');
            $table->string('number',15);
            $table->string('date', 50);
            $table->string('place_issued', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_community_taxes');
    }
};
