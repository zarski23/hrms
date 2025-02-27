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
        Schema::create('evaluator_table', function (Blueprint $table) {
            $table->bigInteger('id',20);
            $table->integer('user_id')->unsigned()->comment('id from users table');
            $table->integer('criteria_id')->unsigned()->comment('id from criteria table');
            $table->boolean('permission')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('evaluator_table');
    }
};
