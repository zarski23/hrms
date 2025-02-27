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
        Schema::connection('second_db')->create('job_positions', function (Blueprint $table) {
            $table->id();
            $table->string('position_id', 10);
            $table->string('job_title')->nullable();
            $table->timestamps();
        });

        DB::connection('second_db')->table('job_positions')->insert([
            ['position_id' => 'P_0001','job_title' => 'Special Education Teacher I', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0002','job_title' => 'Special Education Teacher II', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0003','job_title' => 'Special Education Teacher III', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('job_positions');
    }
};
