<?php

namespace App\Services\Trip;

use App\Repositories\TripRepository;

class TripUpdateService
{

    public function __construct(private TripRepository $tripRepository)
    {}

    public function update(array $data, $id)
    {
        $trip = $this->tripRepository->find($id);

        $trip->update($data);

        return $trip;
    }
}