<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seat extends Model
{
    protected $fillable = [
        'vehicle_id',
        'seat_number',
        'seat_type',
    ];

    public function vehicle(){
        return $this->belongsTo(Vehicle::class);
    }

    public function bookings(){
        return $this->hasMany(Booking::class);
    }

    public function isBookedSeatOnTrip(int $tripId):bool
    {
        $bookedSeat = $this->bookings()
            ->where('trip_id', $tripId)
            ->whereIn('status', ['pending', 'approved'])
            ->exists();
        return $bookedSeat;
    }

}
