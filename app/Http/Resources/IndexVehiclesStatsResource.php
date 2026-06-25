<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class IndexVehiclesStatsResource extends JsonResource
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
            'type' => $this->type,
            'model' => $this->model,
            'capacity' =>$this->capacity,
            'is_active' =>$this->is_active,
            'booked_seats_count' => $this->booked_seats_count,
            'upcoming_schedueld_trips' =>$this->upcoming_schedueld_trips
        ];
    }
}
