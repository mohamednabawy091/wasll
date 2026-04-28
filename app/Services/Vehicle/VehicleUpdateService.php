<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;

class VehicleUpdateService
{
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}