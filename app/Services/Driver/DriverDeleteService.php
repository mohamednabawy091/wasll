<?php

namespace App\Services\Driver;

use App\Repositories\DriverRepository;

class DriverDeleteService
{
    protected $driverRepository;

    public function __construct(DriverRepository $driverRepository)
    {
        $this->driverRepository = $driverRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}