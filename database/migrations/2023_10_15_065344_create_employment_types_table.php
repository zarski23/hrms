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
        Schema::connection('second_db')->create('employment_types', function (Blueprint $table) {
            // $table->id();
            $table->string('employment_type_id');
            $table->string('employment_type')->nullable();
            $table->timestamps();
        });

        DB::connection('second_db')->table('employment_types')->insert([
            ['employment_type_id' => 'ET_0001','employment_type' => 'Elected Officer', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0002','employment_type' => 'Regular', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0003','employment_type' => 'Casual', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0004','employment_type' => 'Job Order', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0005','employment_type' => 'Project Employment', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0006','employment_type' => 'Seasonal Employment', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0007','employment_type' => 'Fixed-Term Employment', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0008','employment_type' => 'Probationary Employment', 'created_at' => now(), 'updated_at' => now()],
            ['employment_type_id' => 'ET_0009','employment_type' => 'Government Internship Program', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employment_types');
    }
};
