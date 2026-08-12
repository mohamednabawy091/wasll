<?php

namespace App\Services\Booking\Admin;

use App\Models\Booking;
use App\Repositories\BookingRepository;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class BookingReadService
{
    use AuthorizesRequests;

    public function __construct(private BookingRepository $bookingRepository)
    {}

    public function read(array $filter)
    {
        $this->authorize('viewAny', Booking::class);
        // Your create logic goes here
        $bookings = $this->bookingRepository->paginated($filter);

        return $bookings;
    }
}