<?php

namespace App\Services\User\Admin;

use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ActivationUserService {

    use AuthorizesRequests;

    public function __construct(private UserRepository $userRepository)
    {}

        public function flipStatus(int $id){

            $this->authorize('flipStatus', User::class);

            $user = $this->userRepository->findOrfail($id);
            $user->update(['is_active' => !$user->is_active]);

            return $user->is_active;
        }
}