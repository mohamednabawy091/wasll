<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class BookingsFilter 
{
    public function applyFilter(Builder $query, array $filter)
    {
        $query->when($filter['status'] ?? null, fn($q, $status) => 
                    $q->where('status', $status))
                ->when($filter['trip_id']?? null, fn($q, $tripId) => 
                    $q->where('trip_id', $tripId))
                ->when($filter['from_date'] ?? null, fn($q, $date) =>
                    $q->whereDate('booking_date', '>=', $date))
                ->when($filter['booking_date'] ?? null, fn($q, $date) => 
                    $q->whereDate('booking_date', '<=', $date));

        return $query;
    }
}