<?php

namespace App\Services\Booking\Admin;

use App\Enum\BookingStatusEnum;
use App\Enum\TicketStatusEnum;
use App\Events\BookingApproved;
use App\Models\Booking;
use App\Repositories\BookingRepository;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;

use function Illuminate\Support\now;

class BookingApproveService
{
    use AuthorizesRequests;
    public function __construct(private BookingRepository $bookingRepository)
    {}

    public function approvedBooking(Booking $booking)
    {
        return DB::transaction(function () use($booking){

            if($booking->status !== BookingStatusEnum::PENDING->value) {
                abort(400, 'this booking can not be approved!');
            }
            
            $booking->update(['status' => BookingStatusEnum::APPROVED->value]);
            $ticket = $booking->ticket()->create([
                    'status' => TicketStatusEnum::ACTIVE->value,
                    'ticket_number' => (string) Str::uuid(),
                    'amount' => $booking-> amount,
                    'issued_at' => now()
                ]);
                $booking->setRelation('ticket', $ticket);
                $booking->load(['user', 'seat']);
                event(new BookingApproved($booking));

                return $booking;
        });

    }
}