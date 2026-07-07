<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Repositories\DriverRepository;
use App\Repositories\TripRepository;
use Carbon\Carbon;
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

        if(Carbon::parse($data['scheduled_departure'])->isPast()){
            abort(422, 'scheduled departure must be a future date and time. ');
        }

        if(Carbon::parse($data['scheduled_arrival'])->lte(Carbon::parse($data['scheduled_departure']))){
            abort(422, 'Scheduled arrival must be after scheduled departure.');
        }
        $tripData = [
            'route_id' => $data['route_id'],
            'pickup_location' => $data['pickup_location'],
            'pickup_latitude' => $data['pickup_latitude'],
            'pickup_longitude' => $data['pickup_longitude'],
            'destination_location' => $data['destination_location'],
            'destination_latitude' => $data['destination_latitude'],
            'destination_longitude' => $data['destination_longitude'],
            'scheduled_departure' => $data['scheduled_departure'],
            'scheduled_arrival' => $data['scheduled_arrival'],
            'fare_amount' => $data['fare_amount'],
            'status' => $data['pending'],
        ];

        $trip = $this->tripRepository->create($tripData);

        return $trip;

    }
}