<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{
    protected $fillable = [
        'driver_id',
        'vehicle_id',
        'route_id',
        'pickup_location',
        'pickup_latitude',
        'pickup_longitude',
        'destination_location',
        'destination_latitude',
        'destination_longitude',
        'scheduled_arrival',
        'actual_pickup_time',
        'actual_dropoff_time',
        'status',
        'fare_amount',
    ];

    protected $casts = [
        'scheduled_at' => 'datetime',
    ];

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class);
    }

    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
