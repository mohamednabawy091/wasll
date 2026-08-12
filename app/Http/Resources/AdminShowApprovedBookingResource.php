<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AdminShowApprovedBookingResource extends JsonResource
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
                'id' => $this->user->id,
                'passenger_name' => $this->user->name,
                'email' => $this->user->email,
            ],

            'seat' => [
                'seat_number' => $this->seat->seat_number,
            ],

            'ticket' => [
                'ticket_number' => $this->ticket->ticket_number,
                'status' =>$this->ticket->status,
                'issued_at' => $this->ticket->issued_at,
            ],

        ];
    }
}
