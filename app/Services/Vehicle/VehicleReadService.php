<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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