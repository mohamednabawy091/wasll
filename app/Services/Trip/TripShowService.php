<?php

namespace App\Services\Trip;

use App\Repositories\TripRepository;

class TripShowService 
{
    public function __construct(private TripRepository $tripRepository)
    {}

    public function show($id)
    {
        $trip = $this->tripRepository->find($id);

        return $trip;
    }
}