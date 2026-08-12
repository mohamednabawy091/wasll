<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Seat extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'vehicle_id',
        'seat_number',
        'seat_type',
        'is_reserved',
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
