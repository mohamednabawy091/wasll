<?php

namespace App\Services\Trip;

use App\Models\Trip;
use App\Repositories\TripRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TripReadService
{
    use AuthorizesRequests;

    public function __construct(private TripRepository $tripRepository)
    {}

    public function read(array $filters)
    {
        $this->authorize('viewAny', Trip::class);
        $trips = $this->tripRepository->index($filters);

        return $trips;
    }
}