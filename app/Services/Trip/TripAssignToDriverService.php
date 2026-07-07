<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Models\User;
use App\Repositories\DriverRepository;
use App\Repositories\TripRepository;
use App\Repositories\UserRepository;
use Exception;

class TripAssignToDriverService
{
    public function __construct(private TripRepository $tripRepository,
                                private DriverRepository $driverRepository,
                                )
    {}

    public function assignToDriver(int $driverId, int $tripId):Trip
    {
        // $adminUser = $this->userRepository->isAdmin();
        /** @var User|null $user */

        $user = auth('api')->user();

        if(!$user || !$user->isAdmin()){
            abort(401, 'Unauthorized!');
        }
        
        //find driver.
        $driver = $this->driverRepository->findOrFail($driverId);

        //find trip
        $trip = $this->tripRepository->findOrFail($tripId);
       
        //check if driver == user type

        if($driver->user->user_type !== 'driver' || !$driver->user->hasVerifiedEmail())
            {
                abort(422, 'This user is not a driver or his email is not verified yet!');
            }

        //check availablity of the driver

        if($driver->status !== 'available')
        {
            abort(422, 'Driver is not available');
        }
        
        // check if trip status pending.
        if($trip->status !=='pending')
            {
                abort(422, "This trip can't be assigned as it is '{$trip->status}'.");
            }
        
        // overlapping
        $overlapping = $this->tripRepository->where('driver_id', $driver->id)
            ->where('trip', '!=' , $trip->id)
            ->whereIn('status', ['scheduled', 'in_progress'])
            ->where('scheduled_arrival', '>', $trip->scheduled_departure)
            ->where('scheduled_departure', '<', $trip->scheduled_arrival)
            ->exists();

        if($overlapping) {
            abort(422, 'This driver already has a trip that conflicts with this time window.');
        }

        $trip->driver_id = $driver->id;
        $trip->status = 'scheduled';
        
        $trip->save();

        $trip->load(['driver.user', 'route', 'vehicle']);

        return $trip;
    }
}