<?php

namespace App\Services\RefreshToken;

use App\Repositories\RefreshTokenRepository;

class RefreshTokenCreateService
{
    protected $refreshtokenRepository;

    public function __construct(RefreshTokenRepository $refreshtokenRepository)
    {
        $this->refreshtokenRepository = $refreshtokenRepository;
    }

    public function create(array $data)
    {
        // Your create logic goes here
    }
}