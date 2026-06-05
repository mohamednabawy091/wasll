<?php

namespace App\Providers;

use App\Events\UserSignedup;
use App\Listeners\SendEmailVerification;
use App\Listeners\SendWelcomeEmail;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    protected array $listen = [
        UserSignedup::class => [
            SendWelcomeEmail::class,
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
