<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $fillable = [
        'type',
        'manufacturer',
        'model',
        'year',
        'license_plate',
        'capacity',
        'latitude',
        'longitude',
        'is_active'
    ];

    public function drivers(){
        return $this->belongsToMany(Driver::class, 'driver_vehicles')
                ->withPivot('shift_start', 'shift_end')
                ->withTimestamps();
    }
}
