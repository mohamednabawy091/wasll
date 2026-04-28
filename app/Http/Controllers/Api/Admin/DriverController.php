<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDriverRequest;
use App\Models\Driver;
use App\Services\Driver\DriverCreateService;
use App\Services\Driver\DriverReadService;
use App\Services\Driver\DriverShowService;
use Illuminate\Http\Request;

class DriverController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(DriverReadService $driverReadService)
    {
        $drivers = $driverReadService->read();

        return response()->json([
            $drivers,
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
    public function store(StoreDriverRequest $storeDriverRequest, DriverCreateService $driverCreateService)
    {

        $driver = $driverCreateService->create($storeDriverRequest->validated());

        return response()->json([
            'message' => 'New driver is added',
            'data' => $driver,
            201
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(DriverShowService $driverShowService, $id)
    {
        $driver = $driverShowService->show($id);

        return response()->json([
            $driver,
            200
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Driver $driver)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Driver $driver)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Driver $driver)
    {
        //
    }
}
