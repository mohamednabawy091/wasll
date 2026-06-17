<?php

namespace App\Services\User\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class UserShowService {

    use AuthorizesRequests;
    public function __construct(private UserRepository $userRepository)
    {}

    public function showUser(int $id){

        
        $user = $this->userRepository->with('driver')->findOrFail($id);

        $this->authorize('view', $user);

        $data = [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'user_type' => $user->user_type,
            'phone' => $user->phone,
        ];

        if($user->user_type === 'driver'){
            $data['driver_profile'] = $user->driver;

            $data ['trips_count'] = $user->driver->trips()->count();
        }

        if($user->user_type === 'passenger'){
            $data['passenger_bookings'] = $user->bookings()->count();
        }

        return $data;

    }
}