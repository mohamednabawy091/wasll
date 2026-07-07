<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminIndexTripsResource extends JsonResource
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
            'pickup_location' => $this->pickup_location,
            'pickup_latitude' => $this->pickup_latitude,
            'pickup_longitude' =>$this->pickup_longitude,
            'destination_location' => $this->destination_location,
            'destination_latitude' => $this->destination_latitude,
            'destination_longitude' => $this->destination_longitude,
            'status' => $this->status,
            'scheduled_arrival' => $this->scheduled_arrival,
            'driver' => new IndexDriverResource($this->whenLoaded('driver')),
            'vehicle' => new IndexVehicleResource($this->whenLoaded('vehicle')),
            'route' => new IndexRouteResource($this->whenLoaded('route')),
        ];
    }
}
