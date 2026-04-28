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
        Schema::table('trips', function (Blueprint $table) {
            //Delete foreign key
            $table->dropForeign(['passenger_id']);
            //Delete column
            $table->dropColumn('passenger_id');

            $table->foreignId('created_by')->constrained('users')
                ->cascadeOnDelete()->cascadeOnUpdate();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('trips', function (Blueprint $table) {

        $table->dropForeign(['created_by']);
        $table->dropColumn('created_by');

        $table->foreignId('passenger_id')
              ->constrained('users')
              ->cascadeOnDelete()
              ->cascadeOnUpdate();
        });
    }
};
