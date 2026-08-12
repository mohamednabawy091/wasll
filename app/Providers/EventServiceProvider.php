<?php

namespace App\Providers;

use App\Events\BookingApproved;
use App\Events\UserSignedup;
use App\Listeners\SendTicketEmail;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected array $listen = [
        UserSignedup::class => [
            SendWelcomeEmail::class,
        ],

        BookingApproved::class => [
            SendTicketEmail::class,
        ],

    ];

    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
