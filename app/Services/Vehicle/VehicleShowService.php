<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;

class VehicleShowService 
{
    public function __construct(private VehicleRepository $vehicleRepository)
    {}

    public function show($id)
    {
        $vehicle = $this->vehicleRepository->find($id);

        return $vehicle;
    }
}