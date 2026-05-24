<?php

namespace App\Services\User;

use App\Repositories\UserRepository;

class UserDeleteService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}