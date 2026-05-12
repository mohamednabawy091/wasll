<?php

namespace App\Services\RefreshToken;

use App\Repositories\RefreshTokenRepository;

class RefreshTokenDeleteService
{
    protected $refreshtokenRepository;

    public function __construct(RefreshTokenRepository $refreshtokenRepository)
    {
        $this->refreshtokenRepository = $refreshtokenRepository;
    }

    public function delete(array $data)
    {
        // Your create logic goes here
    }
}