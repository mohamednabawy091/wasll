<?php

namespace App\Services\Vehicle;

use App\Repositories\SeatRepository;
use App\Repositories\VehicleRepository;
use App\Services\Seat\SeatCreateService;
use Illuminate\Support\Facades\DB;

class VehicleCreateService
{

    public function __construct(private VehicleRepository $vehicleRepository,
                                private SeatRepository $seatRepository,
                                private SeatCreateService $seatCreateService)
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
             return DB::transaction(function() use ($vehicleData){
                
                $vehicle = $this->vehicleRepository->create($vehicleData);

                $this->seatCreateService->generateSeatForVehicle($vehicle);

                return $vehicle;
            });
        }
    }
