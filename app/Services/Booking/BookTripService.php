<?php

namespace App\Services\Booking;

use App\Repositories\BookingRepository;
use App\Repositories\SeatRepository;
use App\Repositories\TripRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\Facades\DB;

class BookTripService {

    public function __construct(private BookingRepository $bookingRepository,
                                private TripRepository $tripRepository,
                                private SeatRepository $seatRepository,
                                private UserRepository $userRepository)
    {}

    public function bookNewTrip(int $seatId, int $tripId)
    {
        $trip = $this->tripRepository->findOrFail($tripId);

        $seat = $this->seatRepository->findOrFail($seatId);

        //check if the trip is bookable.

        if(! in_array($trip->status, ['pending', 'assigned'])){
            abort(422, 'this trip is {{$trip->status}}');
        }

        //check if the seat is already booked

        if($seat->isBookedSeatOnTrip($trip->id)){
            abort(422, 'this seat is reserved');
        }

        //check if this seat belongs to this trip

        if($seat->vehicle_id !== $trip->vehicle_id){
            abort(422, 'this seat is not in the trip {{$trip}}');
        }

        $book = DB::transaction(function() use ($trip, $seat){
            return $this->bookingRepository->create([
                'trip_id' => $trip->id,
                'passenger_id' => auth('api')->user()->id,
                'seat_id' => $seat->id,
                'status' => 'pending',
                'amount' => $trip->fare_amount,
                'booking_date' => now(),
            ]);
        });

        return $book;
    }
}