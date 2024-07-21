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
        Schema::connection('second_db')->create('employee_positions', function (Blueprint $table) {
            // $table->id();
            $table->string('position_id');
            $table->string('position_name')->nullable();
            $table->timestamps();
        });

        DB::connection('second_db')->table('employee_positions')->insert([
            ['position_id' => 'P_0001','position_name' => 'Municipal Mayor', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0002','position_name' => 'Municipal Accountant', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0003','position_name' => 'Municipal Treasurer', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0004','position_name' => 'Municipal Budget Officer', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0005','position_name' => 'Disbursing Officer', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0006','position_name' => 'Local Disaster Risk Reduction and Management Officer', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0007','position_name' => 'Department Head', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0008','position_name' => 'Administrator', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0009','position_name' => 'Municipal Agriculturist', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0010','position_name' => 'Administrative Assistant I', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0011','position_name' => 'Administrative Assistant II', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0012','position_name' => 'Administrative Aide I', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0013','position_name' => 'Administrative Aide II', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0014','position_name' => 'Office Admin', 'created_at' => now(), 'updated_at' => now()],
            ['position_id' => 'P_0015','position_name' => 'Office Staff', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_positions');
    }
};
