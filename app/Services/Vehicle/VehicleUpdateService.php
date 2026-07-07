<?php

namespace App\Services\Vehicle;

use App\Repositories\SeatRepository;
use App\Repositories\VehicleRepository;
use Illuminate\Support\Facades\DB;

class VehicleUpdateService
{

    public function __construct(private VehicleRepository $vehicleRepository, private SeatRepository $seatRepository)
    {}

    public function update(array $data, int $id)
    {
        // Your create logic goes here

        $vehicle = $this->vehicleRepository->findOrFail($id);

        $vehicleCapacity = $vehicle->capacity;

        $newCapacity = $data['capacity'] ?? $vehicleCapacity;

        return DB::transaction(function() use($vehicle, $data, $vehicleCapacity, $newCapacity){
        
            $vehicle->update($data);

            if($newCapacity > $vehicleCapacity){
                $this->seatRepository->addSeats($vehicle, $vehicleCapacity, $newCapacity);

            }elseif($newCapacity < $vehicleCapacity){
                $this->seatRepository->removeSeat($vehicle, $newCapacity);
            }

            return $vehicle;
        });


    }
}