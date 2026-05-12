<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\UserSignupRequest;
use App\Http\Resources\AuthResource;
use App\Models\User;
use App\Services\RefreshToken\GenerateRefreshTokenService;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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

    public function login(LoginRequest $request, GenerateRefreshTokenService $generateRefreshTokenService)
    {
        $userByEmail = User::where('email', $request->email)->first();

        $credentials = $request->only('email', 'password');

        if(! $userByEmail){
            return response()->json([
                'error' => 'User not found'
            ], 400);
        }
        //validation password.
        $validPassword = Hash::check($request->password, $userByEmail->password);

        if(!$validPassword){
            return response()->json([
                'error' => 'Invalid Password'
            ], 400);
        }

        if(!$token = JWTAuth::attempt($credentials)){
            return response()->json([
                'error' => 'Invalid Credentials'
            ], 401);
        }

        $user = auth('api')->user();

        $refreshToken = $generateRefreshTokenService->generateRefreshToken($user);

        $cookie = Cookie::make(
            'refresh_token',
            $refreshToken,
            60 * 24 * 7,
            '/',
            null,
            false,
            true,
            false,
            'Lax'
        );

        $expirationTime = config('jwt.ttl');

        return (new AuthResource($user, $token, $expirationTime))
            ->response()
            ->withCookie($cookie);
    }
}
