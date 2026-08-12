<?php

namespace App\Services\Trip;

use App\Enum\BookingStatusEnum;
use App\Repositories\TripRepository;

class TripBookedSeatsService
{

    public function __construct(private TripRepository $tripRepository)
    {}

    public function bookedSeats(int $id)
    {
        // Your create logic goes here
        $trip = $this->tripRepository->findORFail($id);

       return $trip->vehicle->seats()
            ->with(['bookings' => function ($query) use ($trip){
                $query->where('trip_id', $trip->id)
                    ->whereIn('status', [BookingStatusEnum::PENDING->value, BookingStatusEnum::APPROVED->value]);
            }])->get();

    }
}