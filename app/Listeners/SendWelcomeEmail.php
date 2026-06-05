<?php

namespace App\Listeners;

use App\Events\UserSignedup;
use App\Mail\WelcomeUserMail;
use Carbon\Carbon;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

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
        $user = $event->user;

        $verificationUrl = URL::temporarySignedRoute(
            'verification.verify',
            Carbon::now()->addHours(24),
            [
                'id' => $user->id,
                'hash' => sha1($user->email),
            ]
        );

        Mail::purge('smtp');

        Mail::to($user->email)
            ->send(new WelcomeUserMail($user, $verificationUrl));
    }
}
