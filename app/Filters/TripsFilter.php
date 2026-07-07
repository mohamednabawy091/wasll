<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TripsFilter
{
    public function applyFilter(Builder $query, array $filters)

    {
        if(isset($filters['status'])){
            $query->where('status', $filters['status']);
        }

        if(isset($filters['route_id'])){
            $query->where('route_id', $filters['route_id']);
        }

        if(isset($filters['from_date'])){
            $query->where('scheduled_arrival', '>=', $filters['from_date']);
        }

        if(isset($filters['to_date'])){
            $query->where('scheduled_arrival', '<=', $filters['to_date']);
        }

        return $query;
    }
}