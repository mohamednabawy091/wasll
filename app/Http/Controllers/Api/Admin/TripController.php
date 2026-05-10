<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTripRequest;
use App\Http\Requests\TripAssignToDriverRequest;
use App\Http\Requests\UpdateTripRequest;
use App\Models\Trip;
use App\Services\Trip\TripAssignToDriverService;
use App\Services\Trip\TripCreateService;
use App\Services\Trip\TripReadService;
use App\Services\Trip\TripShowService;
use App\Services\Trip\TripUpdateService;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class TripController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(TripReadService $tripReadService)
    {
        $trips = $tripReadService->read();

        return response()->json([
            $trips,
            200
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(TripCreateService $tripCreateService)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTripRequest $storeTripRequest, TripCreateService $tripCreateService)
    {
        $this->authorize('create', Trip::class);

        $trip = $tripCreateService->create($storeTripRequest->validated(), auth('api')->user());

        return response()->json([
            'message' => 'Trip created successfuly',
            'data' => $trip,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(TripShowService $tripShowService, int $id)
    {
        $trip = $tripShowService->show($id);

        return response()->json([
            $trip,
            200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Trip $trip)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTripRequest $updateTripRequest, TripUpdateService $tripUpdateService, $id)
    {
        $trip = $tripUpdateService->update($updateTripRequest->validated(), $id);

        return response()->json([
            $trip,
            201
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Trip $trip)
    {
        //
    }

    public function assignToDriver(TripAssignToDriverRequest $request,
                TripAssignToDriverService $tripAssignToDriverService)
    {
        $data = $request->validated();

        $tripAssigned = $tripAssignToDriverService->assignToDriver(
            $data['driver_id'],
            $data['trip_id']
        );

        return response()->json([
            'message' => 'assigned successfully',
            'trip' => $tripAssigned
        ],200);
    }
}
