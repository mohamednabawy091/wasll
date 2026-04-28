<?php

namespace App\Services\Route;

use App\Repositories\RouteRepository;

class RouteDeleteService
{
    protected $routeRepository;

    public function __construct(RouteRepository $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}