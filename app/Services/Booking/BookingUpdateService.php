<?php

namespace App\Services\Booking;

use App\Repositories\BookingRepository;

class BookingUpdateService
{
    protected $bookingRepository;

    public function __construct(BookingRepository $bookingRepository)
    {
        $this->bookingRepository = $bookingRepository;
    }

    public function update(array $data)
    {
        // Your create logic goes here
    }
}