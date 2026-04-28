<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthResource extends JsonResource
{

    protected $token;
    protected $expiresIn;

    public function __construct($resource, $token = null, $expiresIn = null)
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

            'token_type' => 'Bearer',
            'access_token' => $this->token ?? null,
            'expires_in' => $this->expiresIn,
            'user' => new UserResource($this->resource),
        ];
    }
}
