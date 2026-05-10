<?php

use App\Http\Controllers\Api\Frontend\AuthController;
use App\Http\Controllers\Api\Frontend\UserController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'], function(){
        Route::post('/register', [AuthController::class, 'signup']);

    Route::group(['middleware' => ['auth:api']], function(){
        Route::get('/profile', [UserController::class, 'me']);
        Route::post('user/picture', [UserController::class, 'uploadProfilePicture']);
    });
});
