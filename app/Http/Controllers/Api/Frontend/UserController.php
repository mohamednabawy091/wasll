<?php
namespace App\Http\Controllers\Api\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateProfilePicture;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function me(){
        return response()->json([
            'user' => auth('api')->user(),
        ]);
    }

    public function uploadProfilePicture(UpdateProfilePicture $request){

        $user = request()->user();

        if($user->profile_picture){
            Storage::disk('public')
                ->delete($user->profile_picture);
        }

        $file = $request->file('profile_picture');

        $fileName = Str::uuid().'.'.$file->getClientOriginalExtension();

        $path = $file->storeAs(
            'avatars',
            $fileName,
            'public'
        );
        // ->store('avatars', 'public');

        $user->update([
            'profile_picture' => $path,
        ]);

        $user->save();

        return response()->json([
            'message' => 'profile picture uploaded successfully',
            'path' => $path,
            'url' => Storage::url($path),
        ]);
    }
    
}