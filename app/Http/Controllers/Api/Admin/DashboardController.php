<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Services\DashboardStatsService;

class DashboardController extends Controller
{
    public function statistics (DashboardStatsService $stats){
        return response()->json([
            'data' => $stats->dashboardStats(),
        ], 200);
    }
}
