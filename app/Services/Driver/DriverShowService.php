<?php

namespace App\Services\Driver;

use App\Repositories\DriverRepository;

class DriverShowService {

    public function __construct(private DriverRepository $driverRepository)
    {}

    public function show ($id)
    {
        $driver = $this->driverRepository->find($id);

        return $driver;
    }

}