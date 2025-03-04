<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::connection('second_db')->create('application', function (Blueprint $table) {
            $table->id();
            $table->string('application_code', 100);
            $table->string('application_title', 100);
            $table->string('school_name', 150)->nullable();
            $table->string('school_barangay', 100)->nullable();
            $table->string('school_municipality', 100)->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('application');
    }
};
