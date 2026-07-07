<?php

namespace App\Services\Route;

use App\Models\Route;
use App\Repositories\RouteRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class RouteReadService
{
    use AuthorizesRequests;

    public function __construct(private RouteRepository $routeRepository)
    {}

    public function read(?bool $activeOnly = null)
    {
        $this->authorize('viewAny', Route::class);
        $routes = $this->routeRepository->indexRoutes($activeOnly);

        return $routes;
        
    }
}