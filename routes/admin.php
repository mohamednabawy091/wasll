<?php

use App\Http\Controllers\Api\Admin\AuthController;
use App\Http\Controllers\Api\Admin\DriverController;
use App\Http\Controllers\Api\Admin\RouteController;
use App\Http\Controllers\Api\Admin\TripController;
use App\Http\Controllers\Api\Admin\VehicleController;
use App\Http\Controllers\Api\Frontend\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function (){
    //public auth route
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);

   
    Route::group(['middleware' => ['auth:api', 'admin']], function(){

        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/profile', [UserController::class, 'me']);
        Route::get('/counts', [UserController::class, 'tripCount']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::post('/route', [RouteController::class, 'store']);
        Route::post('/driver', [DriverController::class, 'store']);
        Route::post('/vehicle', [VehicleController::class, 'store']);
        Route::post('/trip', [TripController::class, 'store']);
        Route::get("/drivers", [DriverController::class, 'index']); //Read all drivers
        Route::get("/routes", [RouteController::class, 'index']);
        Route::get("/trips", [TripController::class, 'index']);
        Route::get("/vehicles", [VehicleController::class, 'index']);
        Route::get("/driver/{id}", [DriverController::class, 'show']);
        Route::get("/route/{id}", [RouteController::class, 'show']);
        Route::get("/trip/{id}", [TripController::class, 'show']);
        Route::get("/vehicle/{id}", [VehicleController::class, 'show']);
        Route::post("/trip/{id}", [TripController::class, 'update']);
    });
        
});