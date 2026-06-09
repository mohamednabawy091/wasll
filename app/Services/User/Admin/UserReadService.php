<?php

namespace App\Services\User\Admin;

use App\Repositories\UserRepository;

class UserReadService
{

    public function __construct(private UserRepository $userRepository)
    {}

    public function read(array $data)
    {
        // Your create logic goes here

        return $this->userRepository->getUsers($data);
    }
}