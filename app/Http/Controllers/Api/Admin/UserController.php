<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFilterRequest;
use App\Http\Resources\AdminUsersResource;
use App\Services\User\Admin\UserReadService;

class UserController extends Controller
{
    public function index(UserFilterRequest $userFilterRequest, UserReadService $userReadService){

        $users = $userReadService->read($userFilterRequest->validated());

        return response()->json([
            AdminUsersResource::collection($users),
        ], 200);
    }
}