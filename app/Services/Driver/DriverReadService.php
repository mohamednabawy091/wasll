<?php

namespace App\Services\Driver;

use App\Repositories\DriverRepository;

class DriverReadService
{

    public function __construct(private DriverRepository $driverRepository)
    {
    }

    public function read()
    {
        // Your create logic goes here
        $drivers = $this->driverRepository->get();

        return $drivers;
    }
}