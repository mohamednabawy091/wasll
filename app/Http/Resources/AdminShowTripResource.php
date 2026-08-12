<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminShowTripResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $booking = $this->bookings->first();
        return [
            'seat_id' => $this->id,
            'seat_number' => $this->seat_number,
            'seat_type' => $this->seat_type,
            'status' => $booking?->status,
            'booking_id' => $booking?->id,
            'passenger_id' => $booking?->passenger_id,
           
        ];
    }
}
