<?php

namespace App\Services\\Seat;

use App\Repositories\SeatRepository;

class SeatReadService
{
    protected $seatRepository;

    public function __construct(SeatRepository $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }

    public function read(array $data)
    {
        // Your create logic goes here
    }
}