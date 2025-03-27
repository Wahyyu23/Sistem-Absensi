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
        Schema::create('attendances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeeId')->nullable()->constrained('employees')->onDelete('set null');
            $table->timestamp('checkInTime')->nullable();
            $table->timestamp('checkOutTime')->nullable();
            $table->string('status');
            $table->foreignId('shiftId')->nullable()->constrained('shifts', 'shiftId')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attendances');
    }
};
