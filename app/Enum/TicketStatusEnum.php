<?php

namespace App\Enum;

enum TicketStatusEnum: string

{
    case ACTIVE = 'active';

    case USED = 'used';

    case CANCELLED = 'cancelled';
}