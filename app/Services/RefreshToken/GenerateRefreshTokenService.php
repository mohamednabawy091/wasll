<?php

namespace App\Services\RefreshToken;

use App\Models\User;
use App\Repositories\RefreshTokenRepository;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class GenerateRefreshTokenService
{
    protected $refreshtokenRepository;

    public function __construct(RefreshTokenRepository $refreshtokenRepository)
    {
        $this->refreshtokenRepository = $refreshtokenRepository;
    }

    public function generateRefreshToken(User $user): string
    {
        // Your create logic goes here
        $plainToken = Str::Random(64);

        $tokenId = Str::uuid()->toString();

        $this->refreshtokenRepository->create([
            'user_id' => $user->id,
            'token' => Hash::make($plainToken),
            'token_id' => $tokenId,
            'expires_at' => Carbon::now()->addDays(7)
        ]);

        
        return $tokenId.'|'.$plainToken;

    }
}