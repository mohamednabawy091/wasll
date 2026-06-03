<?php

namespace App\Services\Route;

use App\Repositories\RouteRepository;

class RouteReadService
{

    public function __construct(private RouteRepository $routeRepository)
    {}

    public function read()
    {
        $routes = $this->routeRepository->get();

        return $routes;
    }
}