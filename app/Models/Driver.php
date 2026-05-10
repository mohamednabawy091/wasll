<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Driver extends Model
{

    protected $fillable = [
        'user_id',
        'license_number',
        'license_expiry_date',
        'is_verified',
        'rating',
        'total_trips',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function vehicles()
    {
        return $this->belongsToMany(Vehicle::class, 'driver_veichles')
                ->withPivot('shift_start', 'shift_end')
                ->withTimestamps();
    }

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
