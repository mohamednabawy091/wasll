<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminIndexRoutesResource extends JsonResource
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
            'start_location' => $this->start_location,
            'end_location' => $this->end_location,
            'is_active' => $this->is_active,
            'trips_count' => $this->trips_count
        ];
    }
}
