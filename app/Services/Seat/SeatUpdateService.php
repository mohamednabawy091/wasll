<?php

namespace App\Services\\Seat;

use App\Repositories\SeatRepository;

class SeatUpdateService
{
    protected $seatRepository;

    public function __construct(SeatRepository $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}