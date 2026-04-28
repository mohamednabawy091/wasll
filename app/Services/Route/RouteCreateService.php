<?php

namespace App\Services\Route;

use App\Repositories\RouteRepository;

class RouteCreateService
{
    protected $routeRepository;

    public function __construct(RouteRepository $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    public function create(array $data)
    {
        // Your create logic goes here

        $routeData = [
            'name' => $data['name'],
            'type' => $data['type'],
            'start_location' => $data['start_location'],
            'end_location' => $data['end_location'],
            'distance_km' => $data['distance_km'],
            'estimated_duration_minutes' => $data['estimated_duration_minutes'],
            'is_active' => $data['is_active']
        ];

        $route = $this->routeRepository->create($routeData);

        return $route;


    }
}