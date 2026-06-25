<?php

namespace App\Services\Vehicle;

use App\Repositories\VehicleRepository;

class VehicleCreateService
{

    public function __construct(private VehicleRepository $vehicleRepository)
    {}

    public function create(array $data)
    {
        // Your create logic goes here
        $vehicleData = [
            'type' => $data['type'],
            'manufacturer' => $data['manufacturer'],
            'model' => $data['model'],
            'year' => $data['year'],
            'license_plate' => $data['license_plate'],
            'capacity' => $data['capacity'],
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
        ];

        $vehicle = $this->vehicleRepository->create($vehicleData);

        return $vehicle;
    }
}