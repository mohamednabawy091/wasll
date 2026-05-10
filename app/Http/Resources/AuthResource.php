<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{

    protected ?string $token;
    protected ?string $expiresIn;

    public function __construct(mixed $resource, ?string $token = null, ?int $expiresIn = null)
    {
        parent::__construct($resource);
        $this->token = $token;
        $this->expiresIn = $expiresIn;

    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'user' => new UserResource($this->resource),
            'token_type' => 'Bearer',
            'access_token' => $this->token ?? null,
            'expires_in' => $this->expiresIn,
        ];
    }
}
