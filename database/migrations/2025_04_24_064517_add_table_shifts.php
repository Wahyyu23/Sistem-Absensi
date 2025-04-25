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
        schema::table('shifts', function (Blueprint $table) {
            // $table->addColumn('string', 'shiftName', ['length' => 50])->nullable() ->after ('shiftId');
            // $table->addColumn('integer', 'workHours', ['length' => 100])->nullable() ->after ('endDate');
            // $table->addColumn('string', 'notes', ['length' => 255]) ->nullable() ->after ('workHours');
            $table->string('shiftName')->nullable()->after('shiftId');
            $table->integer('workHours')->nullable()->after('endDate');
            $table->string('notes')->nullable()->after('workHours');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::table('shifts', function (Blueprint $table) {
            $table->dropColumn('shiftName');
            $table->dropColumn('workHours');
            $table->dropColumn('notes');
        });
    }
};
