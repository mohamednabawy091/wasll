<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;

class VehicleStatsService {
    
    public function __construct(private VehicleRepository $vehicleRepository)
    {}

    public function VehicleStats(){
        
        $vehicleList = $this->vehicleRepository->getVehicleStats();

        return $vehicleList;

    }
}