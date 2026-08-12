<?php

namespace App\Services\Ticket;

use App\Repositories\TicketRepository;
use Illuminate\Support\Carbon;

class TicketCreateService
{
    protected $ticketRepository;

    public function __construct(TicketRepository $ticketRepository)
    {
        $this->ticketRepository = $ticketRepository;
    }

    public function create(array $data)
    {
        // Your create logic goes here
    }
}