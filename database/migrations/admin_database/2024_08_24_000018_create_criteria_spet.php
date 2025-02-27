<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('criteria_spet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('criteria');
            $table->string('sub_criteria')->nullable();
            $table->double('standard_points', 8, 2)->nullable();
            $table->timestamps();
        });

        DB::table('criteria_spet')->insert([
            ['criteria' => 'Performance Rating', 'sub_criteria' => null,'standard_points' => 35, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Experience', 'sub_criteria' => null, 'standard_points' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Outstanding Accomplishments (Meritorious Accomplishments)', 'sub_criteria' => null,'standard_points' => null, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Outstanding Accomplishments (Meritorious Accomplishments)', 'sub_criteria' => 'Outstanding Employee Award', 'standard_points' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Outstanding Accomplishments (Meritorious Accomplishments)', 'sub_criteria' => 'Innovations', 'standard_points' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Outstanding Accomplishments (Meritorious Accomplishments)', 'sub_criteria' => 'Research & Development Projects', 'standard_points' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Outstanding Accomplishments (Meritorious Accomplishments)', 'sub_criteria' => 'Publication / Authorship', 'standard_points' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Outstanding Accomplishments (Meritorious Accomplishments)', 'sub_criteria' => 'Consultant / Resource Speaker in Training / Seminars', 'standard_points' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Education & Training','sub_criteria' => null, 'standard_points' => null,'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Education & Training', 'sub_criteria' => 'Education', 'standard_points' => 25, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Education & Training', 'sub_criteria' => 'Training', 'standard_points' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Potential','sub_criteria' => null, 'standard_points' => 5, 'created_at' => now(), 'updated_at' => now()],
            ['criteria' => 'Psychosocial Attributes & Personality Traits', 'sub_criteria' => null, 'standard_points' => 5, 'created_at' => now(), 'updated_at' => now()],
        ]);
    }




    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('criteria_spet');
    }
};
