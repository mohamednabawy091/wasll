<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreVehicleRequest;
use App\Http\Resources\IndexVehiclesStatsResource;
use App\Models\Vehicle;
use App\Services\Vehicle\VehicleCreateService;
use App\Services\Vehicle\VehicleReadService;
use App\Services\Vehicle\VehicleShowService;
use App\Services\Vehicle\VehicleStatsService;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(VehicleReadService $vehicleReadService)
    {
        $vehicles = $vehicleReadService->read();

        return response()->json([
            $vehicles,
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
    public function store(StoreVehicleRequest $storeVehicleRequest, VehicleCreateService $vehicleCreateService)
    {
        $vehicle = $vehicleCreateService->create($storeVehicleRequest->validated());

        return response()->json([
            'message' => 'Vehicle added successfuly',
            'data' => $vehicle,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(VehicleShowService $vehicleShowService, $id)
    {
        $vehicle = $vehicleShowService->show($id);

        return response()->json([
            $vehicle,
            200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Vehicle $vehicle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Vehicle $vehicle)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Vehicle $vehicle)
    {
        //
    }

    public function vehiclesListStats(VehicleStatsService $vehicleStatsService){
        
        $vehicleStats = $vehicleStatsService->VehicleStats();

        return response()->json([
            'success' => true,
            'stats' => IndexVehiclesStatsResource::collection($vehicleStats),
        ], 200);
    }
}
