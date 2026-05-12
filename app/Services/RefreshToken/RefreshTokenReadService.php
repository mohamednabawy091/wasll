<?php

namespace App\Services\RefreshToken;

use App\Repositories\RefreshTokenRepository;

class RefreshTokenReadService
{
    protected $refreshtokenRepository;

    public function __construct(RefreshTokenRepository $refreshtokenRepository)
    {
        $this->refreshtokenRepository = $refreshtokenRepository;
    }

    public function read(array $data)
    {
        // Your create logic goes here
    }
}