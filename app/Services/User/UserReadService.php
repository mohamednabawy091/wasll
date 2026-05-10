<?php

namespace App\Services\\User;

use App\Repositories\UserRepository;

class UserReadService
{
    protected $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function read(array $data)
    {
        // Your create logic goes here
    }
}