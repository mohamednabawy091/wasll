<?php

namespace App\Services\Seat;

use App\Models\Seat;
use App\Repositories\SeatRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class SeatCreateService
{
    use AuthorizesRequests;

    public function __construct(private SeatRepository $seatRepository)
    {}

    public function create(array $data)
    {
        // Your create logic goes here

        $this->authorize('create', Seat::class);

        $seat = $this->seatRepository->createSeat($data);

        return $seat;
    }
}