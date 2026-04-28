<?php

namespace App\Services\Trip;

use App\Repositories\TripRepository;

class TripReadService
{

    public function __construct(private TripRepository $tripRepository)
    {}

    public function read()
    {
        // Your create logic goes here
        $trips = $this->tripRepository->all();

        return $trips;
    }
}