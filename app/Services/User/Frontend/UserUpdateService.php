<?php

namespace App\Services\User\Frontend;

use App\Repositories\UserRepository;

class UserUpdateService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}