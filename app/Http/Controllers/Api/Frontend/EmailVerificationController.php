<?php

namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class EmailVerificationController extends Controller
{
    public function verify(Request $request){

        $user = User::findorFail($request->id);

        if(! $request->hasValidSignature()){
            return response()->json([
                'success' => false,
                'meassage' => 'Invalid or Expired link'
            ], 403);
        }

        if(! hash_equals(sha1($user->email), $request->hash)){
            return response()->json([
                'success' => false,
                'message' => 'Invalid verification data'
            ], 403);
        }

        if(! $user->hasVerifiedEmail()){
             $user->markEmailAsVerified();
        }

        return response()->json([
            'success' => true,
            'message' => 'Email verified successfully'
        ]);
    }
}
