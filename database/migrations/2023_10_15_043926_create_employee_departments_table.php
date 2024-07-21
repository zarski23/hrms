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
        Schema::connection('second_db')->create('employee_departments', function (Blueprint $table) {
            // $table->id();
            $table->string('department_id');
            $table->string('department_name')->nullable();
            $table->timestamps();
        });   

        DB::connection('second_db')->table('employee_departments')->insert([
            ['department_id' => 'D_0001','department_name' => 'Mayor’s Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0002','department_name' => 'Human Resource Management Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0003','department_name' => 'Sangguniang Bayan Sec. Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0004','department_name' => 'Sangguniang Bayan Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0005','department_name' => 'Municipal Treasury Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0006','department_name' => 'Municipal Health Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0007','department_name' => 'Municipal Engineering Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0008','department_name' => 'Municipal Agriculture Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0009','department_name' => 'Municipal Accounting Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0010','department_name' => 'Municipal Assessor’s Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0011','department_name' => 'Municipal Social Welfare And Development Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0012','department_name' => 'Municipal Planning And Development Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0013','department_name' => 'Municipal Civil Registry', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0014','department_name' => 'Municipal Budget Office', 'created_at' => now(), 'updated_at' => now()],
            ['department_id' => 'D_0015','department_name' => 'Casual Employees', 'created_at' => now(), 'updated_at' => now()],
        ]);

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::connection('second_db')->dropIfExists('employee_departments');
    }
};
