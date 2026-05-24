<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Repositories\TripRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TripCreateService
{
    use AuthorizesRequests;
    public function __construct(private TripRepository $tripRepository)
    {}

    public function create(array $data)
    {
        $this->authorize('create', Trip::class);
        // Your create logic goes here
        $tripData = [
            'driver_id' =>$data['driver_id'],
            'route_id' => $data['route_id'],
            'vehicle_id' => $data['vehicle_id'],
            'pickup_location' => $data['pickup_location'],
            'pickup_latitude' => $data['pickup_latitude'],
            'pickup_longitude' => $data['pickup_longitude'],
            'destination_location' => $data['destination_location'],
            'destination_latitude' => $data['destination_latitude'],
            'destination_longitude' => $data['destination_longitude'],
            'scheduled_arrival' => $data['scheduled_arrival'],
            'actual_pickup_time' => $data['actual_pickup_time'],
            'actual_dropoff_time' => $data['actual_dropoff_time'],
            'status' => $data['status'],
            'fare_amount' => $data['fare_amount'],
        ];

        $trip = $this->tripRepository->create($tripData);

        return $trip;

    }
}