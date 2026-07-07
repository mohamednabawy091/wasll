<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexDriverResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->whenLoaded('user', fn() => $this->user->name),
            'email' => $this->whenLoaded('user', fn() => $this->user->email),
            'user_id' => $this->user_id,
            'license_number' => $this->license_number,
            'license_expiry_date' =>$this->license_expiry_date,
            'is_verified' => $this->is_verified,
            'rating' => $this->rating,
            'total_trips' => $this->total_trips,
            'status'=>$this->status,
        ];
    }
}
