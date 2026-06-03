<?php

namespace App\Listeners;

use App\Events\UserSignedup;
use App\Mail\WelcomeUserMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendWelcomeEmail implements ShouldQueue
{

    public int $tries = 3;
    public int $timeout = 30;

    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(UserSignedup $event): void
    {
        Mail::purge('smtp');

        Mail::to($event->user->email)
            ->send(new WelcomeUserMail($event->user));
    }
}
