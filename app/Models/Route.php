<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Route extends Model
{
    protected $fillable = [
        'name',
        'type',
        'start_location',
        'end_location',
        'distance_km',
        'estimated_duration_minutes',
        'is_active',
    ];

    public function trips()
    {
        return $this->hasMany(Trip::class);
    }
}
