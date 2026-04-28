<?php
namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\AuthResource;
use App\Models\RefreshToken;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Facades\JWTAuth;

use function Illuminate\Support\now as SupportNow;
use function Symfony\Component\Clock\now;

class AuthController extends Controller
{

    public function register(AuthRequest $request)
    {
        try{
            $user = User::create([
                'name'=> $request->name,
                'email'=>$request->email,
                'password' => Hash::make($request->password),
                'phone'=>$request->phone,
                'user_type' => $request->user_type ?? 'passenger'
            ]);

            // Generate Token to the user

            $token = JWTAuth::fromUser($user);
            
            return response()->json([ $token,
                $user,
                'user registered successfuly',
                201]);

        }catch(\Exception $e){
            return response()->json([
                'success' => false,
                'message' => 'Registration Faild'
            ], 500);
        }
    }

    /**
     * Login user and return JWT token
     */
    public function login(LoginRequest $request) 
    {
        $credentials = $request->only('email', 'password');

        
        if (! $token = JWTAuth::attempt($credentials)) {
            return response()->json([
                'message' => 'Invalid Credentials'
            ], 401);
        }

        $user = auth('api')->user();

        if(!$this->admin($user)){
            return response()->json([
                'error' => 'Forbidden',
            ], 403);
        }

        // Generate refresh token.

        $refreshToken = $this->generateRefreshToken($user);

        $expirationTime = JWTAuth::factory()->getTTL() * 60;

        return (new AuthResource($user, $token, $expirationTime))
                ->response()
                ->cookie(
                'refresh_token',
                $refreshToken,
                60 * 24 * 7,
                '/',
                null,
                true,
                true,
                false,
                'None'
            );
    }

    public function logout()
    {
        // Implement logout logic here
        try{
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                'message' => 'Logged out',
            ]);

        }catch(\Exception $e){
            return response()->json([
                'message' => 'Token already invalid'
            ], 401);
        }

    }

    public function refresh(){
        try{
            $newToken = JWTAuth::refresh(JWTAuth::getToken());
            return [
                'access_token' => $newToken,
                'token_type' => 'bearer',
                'expires_in' => config('jwt.ttl'),
            ];
        }catch(\Exception $e){
            return response()->json([
            'message' => 'Token refresh failed'
            ], 401);
        }
    }

    private function admin($user){
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