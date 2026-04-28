<?php
namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthService

    /**
    *  @param array $credentials
    *  @param null|string $guard
    *  @return void
    */
{  
    public function attempt(array $credentials, ?string $guard = null){
        $guard = $guard ?? config('auth.defaults.guard');

        //Handle jwt separately

        if(in_array($guard, ['api', 'jwt'])){
            return $this->attemptJwt($credentials);
        }
        
        // Use Auth facade for other guards
        if(!Auth::guard($guard)->attempt($credentials)){
            return false;
        }

        $user = auth($guard)->user();

        $token = $this->generateToken($user, $guard);

        return [
            'user' =>$user,
            'token' => $token,
            'guard' => $guard,
        ];
    }

    /**
     * Generate token based on guard type
     *
     * @param User $user
     * @param string $guard
     * @return array
     */

    protected function generateToken(User $user, string $guard):array
    {
        switch($guard) {
            case 'api':
            case 'jwt':
                //JWT token
                return [
                    'access_token' =>JWTAuth::fromUser($user),
                    'token_type' => 'bearer',
                    'expires_in' => config('jwt.ttl') * 60,
                ];

            case 'sanctum':
                //Sanctum token
                return [
                    'access_token' => $user->createToken('auth_token')->plainTextToken,
                    'token_type' => 'bearer',
                    'expires_in' => null, // Sanctum tokens don't expire by default
                ];
            
            case 'web':
                // Session-based (no token needed)
                return [
                    'access_token' => null,
                    'token_type' => 'session',
                    'expires_in' => config('session.lifetime') * 60,
                ];

            default:
                return [
                    'access_token' => null,
                    'token_type' => 'unknown',
                    'expires_in' => null,
                ];
        }

    }

    protected function attemptJwt(array $credentials){
        if(!$token = JWTAuth::attempt($credentials)){
            return false;
        }

        return [
            'user' => JWTAuth::user(),
            'token' =>[
                'access_token' =>$token,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl') * 60,
            ],
            'guard' => 'api',
        ];
    }
}
        