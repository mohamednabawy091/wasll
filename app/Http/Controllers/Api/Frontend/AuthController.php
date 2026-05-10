<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserSignupRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function signup(UserSignupRequest $request)
    {

        try{
            $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password'=>Hash::make($request->password),
            'phone' => $request->phone,
            'user_type' =>$request->user_type ?? 'passenger'
            ]);

            $token = Auth::fromUser($user);

            return response()->json([
                'data' => $user,
                'token' => $token,
                'User signedup successfully'
            ], 201);
        }catch(Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Signup Failed'
            ], 500);
        }   

    }

    public function login()
    {
        
    }
}
