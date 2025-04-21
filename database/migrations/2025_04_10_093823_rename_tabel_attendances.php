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
            //$table->dropColumn('checkInTime');
            //$table->dropColumn('checkOutTime');
            //$table->string('checkInDay', 50)->nullable();
            //$table->addColumn('date', 'checkInDate');
            //$table->addColumn('string', 'checkInDay');
            //$table->string('checkOutDay', 50)->nullable();
            //$table->addColumn('time', 'checkInTime');
            //$table->addColumn('date', 'checkOutDate');
            //$table->addColumn('string', 'checkOutDay');
            //$table->addColumn('time', 'checkOutTime');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('attendances', function (Blueprint $table) {
            //$table->dropColumn('checkInDate');
            //$table->dropColumn('checkInDay');
            //$table->dropColumn('checkInTime');
            //$table->dropColumn('checkOutDate');
            //$table->dropColumn('checkOutDay');
            //$table->dropColumn('checkOutTime');

            //Untuk penambahan tabel
            //$table->addColumn('checkInTime', 'time');
            //$table->addColumn('checkOutTime', 'time');
        });
    }
};
