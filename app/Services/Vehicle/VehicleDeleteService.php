<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;

class VehicleDeleteService
{
    protected $vehicleRepository;

    public function __construct(VehicleRepository $vehicleRepository)
    {
        $this->vehicleRepository = $vehicleRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}