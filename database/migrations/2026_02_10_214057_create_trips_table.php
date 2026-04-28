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
        Schema::create('trips', function (Blueprint $table) {
            $table->id();

            $table->foreignId('passenger_id')->constrained('users')->onDelete('cascade');
            $table->foreign('passenger_id', 'trips_passenger_id_fk')
            ->references('id')->on('users')
            ->onDelete('cascade');

            $table->foreignId('driver_id')->nullable();
            $table->foreign('driver_id', 'trips_driver_id_fk')
                ->references('id')->on('drivers')
                ->onDelete('cascade');
            $table->foreignId('vehicle_id')->constrained()->onDelete('cascade');
            $table->foreign('vehicle_id', 'trips_vehicle_id_fk')
            ->references('id')->on('vehicles')
            ->onDelete('cascade');

            $table->foreignId('route_id')->constrained()->onDelete('cascade');
            $table->foreign('route_id', 'trips_route_id_fk')
            ->references('id')->on('routes')
            ->onDelete('cascade');
            //pickup
            $table->string('pickup_location');
            $table->decimal('pickup_latitude', 10, 7)->nullable();
            $table->decimal('pickup_longitude', 10, 7)->nullable();
            //destination
            $table->string('destination_location');
            $table->decimal('destination_latitude', 10, 7)->nullable();
            $table->decimal('destination_longitude', 10, 7)->nullable();
            
            $table->index(['pickup_latitude', 'pickup_longitude']);
            $table->dateTime('scheduled_arrival')->index();
            $table->dateTime('actual_pickup_time')->nullable();
            $table->dateTime('actual_dropoff_time')->nullable();
            $table->enum('status', ['pending', 'assigned', 'in_progress', 'completed', 'cancelled'])->default('pending')->index();
            $table->decimal('fare_amount', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trips');
    }
};
