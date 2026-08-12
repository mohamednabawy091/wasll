<?php

namespace App\Enum;

enum BookingStatusEnum: string
{
    case AVAILABLE = 'available';
    case PENDING = 'pending';
    case APPROVED = 'approved';
    case REJECTED = 'rejected';
    case CANCELLED = 'cancelled';
}
