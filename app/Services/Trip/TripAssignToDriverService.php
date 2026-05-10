<?php

namespace App\Services\Trip;

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

    public function assignToDriver(int $driverId, int $tripId)
    {
        // $adminUser = $this->userRepository->isAdmin();
        /** @var User|null $user */

        $user = auth('api')->user();

        if(!$user || !$user->isAdmin()){
            abort(401, 'Unauthorized!');
        }
        
        //find driver.
        $driver = $this->driverRepository->find($driverId);

        if(!$driver)
            {
                abort(404, 'Driver not found!');
            }
        //find trip
        $trip = $this->tripRepository->find($tripId);
        if(!$trip)
            {
                abort(404, 'Trip not found');
            }

        //check if driver == user type

        if($driver->user->user_type !== 'driver')
            {
                abort(422, 'This user is not a driver');
            }
        // check if trip status pending.
        if($trip->status ==='assigned')
            {
                abort(422, 'This trip already assigned to a driver');
            }

        $trip->driver_id = $driver->id;
        $trip->status = 'assigned';
        
        $trip->save();

        return $trip;
    }
}