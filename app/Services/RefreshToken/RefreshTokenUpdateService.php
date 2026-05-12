<?php

namespace App\Services\RefreshToken;

use App\Repositories\RefreshTokenRepository;

class RefreshTokenUpdateService
{
    protected $refreshtokenRepository;

    public function __construct(RefreshTokenRepository $refreshtokenRepository)
    {
        $this->refreshtokenRepository = $refreshtokenRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}