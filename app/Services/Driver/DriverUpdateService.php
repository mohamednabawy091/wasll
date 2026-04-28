<?php

namespace App\Services\Driver;

use App\Repositories\DriverRepository;

class DriverUpdateService
{
    protected $driverRepository;

    public function __construct(DriverRepository $driverRepository)
    {
        $this->driverRepository = $driverRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
        
    }
}