<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;

class VehicleReadService
{
    public function __construct(private VehicleRepository $vehicleRepository)
    {}

    public function read()
    {
        $vehicles = $this->vehicleRepository->all();

        return $vehicles;
    }
}