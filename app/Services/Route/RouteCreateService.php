<?php

namespace App\Services\Route;

use App\Models\Route;
use App\Repositories\RouteRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RouteCreateService
{
    use AuthorizesRequests;

    public function __construct(private RouteRepository $routeRepository)
    {
        
    }

    public function create(array $data)
    {

        // Your create logic goes here

        $this->authorize('create', Route::class);

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