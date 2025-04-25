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
        schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('created_at');
            $table->dropColumn('updated_at');
            $table->dropColumn('checkInDay');
            $table->dropColumn('checkOutDay');
            $table->dropColumn('checkOutDate');
            $table->dropColumn('checkInDate');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('attendances', function (Blueprint $table){
            $table->timestamp('created_at')->nullable();
            $table->timestamp('updated_at')->nullable();
            $table->string('checkInDay')->nullable();
            $table->string('checkOutDay')->nullable();
            $table->date('checkInDate')->nullable();
            $table->date('checkOutDate')->nullable();
        });
    }
};
