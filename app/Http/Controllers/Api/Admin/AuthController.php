<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\RefreshToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;


class AuthController extends Controller
{
    /**
     * Login user and return JWT token
     */
    public function login(LoginRequest $request) 
    {
        $credentials = $request->only(['email', 'password']);

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $user = auth('api')->user();

        // if(!$this->admin($user)){
        //     return response()->json([
        //         'error' => 'Forbidden',
        //     ], 403);
        // }


        /*
         * Generate refresh token.
        */
        $refreshToken = $this->generateRefreshToken($user);

        /*
         * Save refresh token in cookie.
        */
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

    /*
     * Refresh access token. 
    */

    public function refresh(Request $request)
    {
        // get refresh token from token.

        $plainToken = $request->cookie('refresh_token');

        if(!$plainToken){
            return response()->json([
                'message' => 'Refresh token not found'
            ], 401);
        }

        // Find token in database.

        $refreshTokens = RefreshToken::with('user')->get();

        $matchedToken = null;

        foreach($refreshTokens as $refreshToken){
            if(Hash::check($plainToken, $refreshToken->token)){
                $matchedToken = $refreshToken;
                break;
            }
        }

        /*
        * Invalid token.
        */

        if(!$matchedToken){
            return response()->json([
                'message' => 'invalid refresh token'
            ], 400);
        }

        /*
        * expired token
        */

        if($matchedToken->expires_at < now()){
            return response()->json([
                'message' => 'token is expired'
            ], 400);
        }

        $user = $matchedToken->user;

        //Generate new access token.

        $accessToken = JWTAuth::fromUser($user);

        $matchedToken->delete();

        $newRefreshToken = $this->generateRefreshToken($user);

        /* 
            New cookie
        */
        $cookie = Cookie::make(
            'refresh_token',
            $newRefreshToken,
            60 * 24 * 7,
            '/',
            null,
            false,
            true,
            false,
            'Lax'
        );

        $expirationTime = config('jwt.ttl');

        return (new AuthResource($user, $accessToken, $expirationTime))
            ->response()
            ->withCookie($cookie);
    }

    public function logout(Request $request)
    {
        // Implement logout logic here
        try{
            JWTAuth::invalidate(JWTAuth::getToken());

            //Delete refresh token

            $plainToken = $request->cookie('refresh_token');

            if($plainToken){
                $tokens = RefreshToken::all();

                foreach($tokens as $token){
                    if(Hash::check($plainToken, $token->token)){
                        $token->delete();
                        break;
                    }
                }
            }

            /**
             * remove cookie.
             */
            $cookie = Cookie::forget('refresh_token');

            return response()->json([
                'message' => 'Logged out successfully'
            ])->withCookie($cookie);


        }catch(\Exception $e){
            return response()->json([
                'message' => 'Logout Failed'
            ], 500);
        }

    }

    private function admin(User $user){
        if($user->user_type === 'admin'){
            return true;
        }

        return false;
    }

    private function generateRefreshToken(User $user)
    {
        $plainToken = Str::random(64);

        RefreshToken::create([
            'user_id' => $user->id,
            'token' => Hash::make($plainToken),
            'expires_at' => Carbon::now()->addDays(7),
        ]);

        return $plainToken;
    }

    // protected function responseWithJwtToken($token, User $user, $message = 'success', $status = 200){

    //     return response()->json([
    //         'success' => true,
    //         'message' => $message,
    //         'data' => [
    //             'user' => $user,
    //             'token' => $token,
    //             'token_type' => 'bearer',
    //             'expires_in' => config('jwt.ttl')
    //         ]
    //     ], $status);

    // }


}