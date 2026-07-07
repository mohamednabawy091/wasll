<?php

namespace App\Services\Seat;

use App\Models\Seat;
use App\Models\Vehicle;
use App\Repositories\SeatRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SeatCreateService
{
    use AuthorizesRequests;

    public function __construct(private SeatRepository $seatRepository)
    {}

    public function generateSeatForVehicle(Vehicle $vehicle)
    {
        // Your create logic goes here
        $this->seatRepository->createSeat($vehicle);
    }
}