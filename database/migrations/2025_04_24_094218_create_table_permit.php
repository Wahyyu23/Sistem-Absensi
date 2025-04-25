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
        Schema::create('permits', function (Blueprint $table) {
            $table->id();
            $table->string('employeeUID', 255)->nullable();
            $table->foreign('employeeUID')->references('employeeUID')->on('employees')->onDelete('set null');
            $table->integer('attendanceId')->nullable();
            $table->string('permitType', 255)->nullable();
            $table->dateTime('startDate')->nullable();
            $table->dateTime('endDate')->nullable();
            $table->string('approvalBy', 255)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('permits', function (Blueprint $table){
            $table->dropForeign(['employeeUID']);
        });

        Schema::dropIfExists('permits');
    }
};
