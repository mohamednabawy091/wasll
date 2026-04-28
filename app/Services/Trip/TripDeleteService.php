<?php

namespace App\Services\Trip;

use App\Repositories\TripRepository;

class TripDeleteService
{
    protected $tripRepository;

    public function __construct(TripRepository $tripRepository)
    {
        $this->tripRepository = $tripRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}