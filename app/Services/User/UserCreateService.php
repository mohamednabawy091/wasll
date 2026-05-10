<?php

namespace App\Services\\User;

use App\Repositories\UserRepository;

class UserCreateService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function create(array $data)
    {
        // Your create logic goes here
    }
}