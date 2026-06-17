<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserFilterRequest;
use App\Http\Resources\AdminUsersResource;
use App\Models\User;
use App\Services\User\Admin\ActivationUserService;
use App\Services\User\Admin\UserReadService;
use App\Services\User\Admin\UserShowService;
use Illuminate\Http\JsonResponse;

class UserController extends Controller
{
    public function index(UserFilterRequest $userFilterRequest, UserReadService $userReadService){

        $users = $userReadService->read($userFilterRequest->validated());
        return response()->json([
            AdminUsersResource::collection($users),
        ], 200);
    }

    public function show(int $id, UserShowService $userShowService){
        $user = $userShowService->showUser($id);

        return response()->json([
            'data' => $user,
        ], 200);
    }

    public function activationUser(int $id, ActivationUserService $activationUserService):JsonResponse
    {

        $newUserStatus = $activationUserService->flipStatus($id);

        return response()->json([
            'success' => true,
            'message' => 'User Account ' . ($newUserStatus ? 'activated.': 'deactivated.'),
            'is_active' => $newUserStatus
        ], 201);
        
    }
}