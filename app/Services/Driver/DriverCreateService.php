<?php

namespace App\Services\Driver;

use App\Repositories\DriverRepository;

class DriverCreateService
{
    

    public function __construct(private DriverRepository $driverRepository)
    {}

    public function create(array $data)
    {
        // Your create logic goes here
        $driverData =[
            'user_id' => $data['user_id'],
            'license_number' =>$data['license_number'],
            'license_expiry_date' => $data['license_expiry_date'],
            'is_verified' => $data['is_verified'],
            'rating' => $data['rating'],
            'total_trips' => $data['total_trips'],
            'status' => $data['status'],
        ];

        $driver =  $this->driverRepository->create($driverData);

        return $driver;
    }
}