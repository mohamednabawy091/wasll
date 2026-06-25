<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Repositories\TripRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TripAssignToVehicleService {
    use AuthorizesRequests;

    public function __construct(private TripRepository $tripRepository,
                                 private VehicleRepository $vehicleRepository)
    {}

    public function assignToVehicle (int $vehicleId, int $tripId):Trip
    {
        $this->authorize('assignTripToVehicle', Trip::class);

        $vehicle = $this->vehicleRepository->findOrFail($vehicleId);
        $trip = $this->tripRepository->findOrFail($tripId);
        if(!$vehicle->is_active){
            return abort(403, 'Vehicle is not active.');
        }

        if(!in_array($trip->status, ['pending', 'assigned'])){
            return abort(422, 'this trip is not available to be assigned.');
        }

        $trip->vehicle_id = $vehicle->id;

        $trip->save();

        return $trip;
    }
}