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
        Schema::create('employee', function (Blueprint $table) {
            $table->id('employeeId');
            $table->string('username');
            $table->string('password');
            $table->string('employeeName');
            $table->date('dateOfBirth');
            $table->integer('employeePhone');
            $table->string('employeeEmail');
            $table->string('profilePicture');
            $table->string('position');
            $table->string('department');
            $table->date('hireDate');
            $table->date('terminationDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employee');
    }
};
