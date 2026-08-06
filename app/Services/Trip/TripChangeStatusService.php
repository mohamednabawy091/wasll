<?php

namespace App\Services\Trip;

use App\Enum\BookingStatusEnum;
use App\Enum\TripStatusEnum;
use App\Events\TripCancelled;
use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Support\Facades\DB;

class TripChangeStatusService {

    public function __construct(private TripRepository $tripRepository)
    {}

    public function changeTripStatus (int $tripId, string $status)
    {
        $trip = $this->tripRepository->findOrFail($tripId);

        if($trip->status === TripStatusEnum::CANCELLED->value) {

            abort(404, 'this trip is already cancelled!');
        }

        return DB::transaction(function() use($trip, $status) {
            $trip->status = $status;
            $trip->save();

            if($status === TripStatusEnum::CANCELLED->value){
                $this->cancelPendingBookingsAndFreeSeats($trip);
                event(new TripCancelled($trip));
            }

            return $trip->fresh('bookings');
        });
    }

    private function cancelPendingBookingsAndFreeSeats(Trip $trip):void
    {
        $pendingBookings = $trip->bookings()
            ->where('status', BookingStatusEnum::PENDING->value)
            ->with('seat')
            ->get();

        foreach($pendingBookings as $booking)
        {
            $booking->update(['status' => BookingStatusEnum::CANCELLED->value]);
            $booking->seat?->update(['is_reserved' => false]);
        }
    }
}