<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminIndexBookingsResource extends JsonResource
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
            'status' => $this->status,
            'amount' => $this->amount,
            'booking_date' => $this->booking_date,
            'passenger' => [
                'id' => $this->user?->id,
                'passenger_id' => $this->user?->name,
                'passenger_email' => $this->user?->email
            ],
            'trip' => [
                'trip_id' => $this->trip?->id,
                'scheduled_departure' => $this->trip?->scheduled_departure,
            ],
            'seat_number' => $this->seat?->seat_number,
        ];
    }
}
