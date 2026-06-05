<?php

use App\Http\Controllers\Api\Frontend\AuthController;
use App\Http\Controllers\Api\Frontend\EmailVerificationController;
use App\Http\Controllers\Api\Frontend\UserController;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Middleware\ValidateSignature;

Route::group(['prefix' => 'v1'], function(){
        Route::post('/register', [AuthController::class, 'signup']);

        Route::get('/email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verification.verify');

    Route::group(['middleware' => ['auth:api']], function(){
        Route::get('/profile', [UserController::class, 'me']);
        Route::post('user/picture', [UserController::class, 'uploadProfilePicture']);
    });
});

