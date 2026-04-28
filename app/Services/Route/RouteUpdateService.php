<?php

namespace App\Services\Route;

use App\Repositories\RouteRepository;

class RouteUpdateService
{
    protected $routeRepository;

    public function __construct(RouteRepository $routeRepository)
    {
        $this->routeRepository = $routeRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}