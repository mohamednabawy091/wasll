<?php
namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Trip;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function me(){
        return response()->json([
            'user' => auth('api')->user(),
        ]);
    }

    public function tripCount(Request $request, Trip $trip){
       return response()->json([
        'trips' => Trip::count(),
        ]);
    }
}