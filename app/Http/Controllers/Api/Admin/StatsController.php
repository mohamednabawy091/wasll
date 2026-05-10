<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Models\Driver;
use App\Models\Trip;
use App\Models\Vehicle;

class StatsController extends Controller{

    public function showStats(){

        return response()->json([
            'drivers' => Driver::count(),
            'trips' => Trip::count(),
            'vehicles' => Vehicle::count()
        ]);
    }
}