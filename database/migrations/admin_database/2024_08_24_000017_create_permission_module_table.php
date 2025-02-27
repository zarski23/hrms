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
        Schema::create('permission_module', function (Blueprint $table) {
            $table->bigInteger('id',20);
            $table->integer('user_id')->unsigned()->comment('id from users table');
            $table->integer('id_count')->unsigned();
            $table->string('add_action', 5)->nullable();
            $table->string('view_action', 5)->nullable();
            $table->string('update_action', 5)->nullable();
            $table->string('delete_action', 5)->nullable();
            $table->string('upload_action', 5)->nullable();
            $table->string('download_action', 5)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permission_module');
    }
};
