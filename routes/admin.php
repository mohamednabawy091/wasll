<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DashboardController;
use App\Http\Controllers\Api\Admin\DriverController;
use App\Http\Controllers\Api\Admin\RouteController;
use App\Http\Controllers\Api\Admin\StatsController;
use App\Http\Controllers\Api\Admin\TripController;
use App\Http\Controllers\Api\Admin\UserController;
use App\Http\Controllers\Api\Admin\VehicleController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (){
    //public auth route
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/refresh', [AuthController::class, 'refresh']);

    
    Route::group(['middleware' => ['auth:api']], function(){
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    Route::group(['middleware' => ['auth:api', 'admin']], function(){

        Route::get('/counts', [StatsController::class, 'showStats']);
        Route::post('/route', [RouteController::class, 'store']);  // <- this is it 
        Route::post('/driver', [DriverController::class, 'store']);
        Route::post('/vehicle', [VehicleController::class, 'store']);
        Route::post('/trip', [TripController::class, 'store']);
        Route::get("/drivers", [DriverController::class, 'index']);
        Route::get("/routes", [RouteController::class, 'index']);
        Route::get("/trips", [TripController::class, 'index']);
        Route::get("/vehicles", [VehicleController::class, 'index']);
        Route::get("/driver/{id}", [DriverController::class, 'show']);
        Route::get("/route/{id}", [RouteController::class, 'show']);
        Route::get("/trip/{id}", [TripController::class, 'show']);
        Route::get("/vehicle/{id}", [VehicleController::class, 'show']);
        Route::put("/trip/{id}", [TripController::class, 'update']);
        Route::post("/assigntrip", [TripController::class, 'assignToDriver']);
        Route::get("/dashboard/stats", [DashboardController::class, 'statistics']);
        Route::get("/users", [UserController::class, 'index']);
    });
        
});