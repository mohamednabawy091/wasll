<?php

namespace App\Services\Route;

use App\Repositories\RouteRepository;

class RouteShowService {

    public function __construct(private RouteRepository $routeRepository)
    {}

    public function show($id)
    {
        $route = $this->routeRepository->find($id);

        return $route;
    }

}