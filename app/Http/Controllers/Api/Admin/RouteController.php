<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreRouteRequest;
use App\Models\Route;
use App\Services\Route\RouteCreateService;
use App\Services\Route\RouteReadService;
use App\Services\Route\RouteShowService;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(RouteReadService $routeReadService)
    {
        $routes = $routeReadService->read();

        return response()->json([
            $routes,
            200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRouteRequest $storeRouteRequest, RouteCreateService $routeCreateService)
    {
        $route = $routeCreateService->create($storeRouteRequest->validated());

        return response()->json([
            'message' => 'Route created successfuly',
            $route,
            201
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(RouteShowService $routeShowService, $id)
    {
        $route = $routeShowService->show($id);

        return response()->json([
            $route,
            200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Route $route)
    {
        //
    }
}
