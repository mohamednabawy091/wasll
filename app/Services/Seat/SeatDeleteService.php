<?php

namespace App\Services\\Seat;

use App\Repositories\SeatRepository;

class SeatDeleteService
{
    protected $seatRepository;

    public function __construct(SeatRepository $seatRepository)
    {
        $this->seatRepository = $seatRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}