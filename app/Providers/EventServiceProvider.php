<?php

namespace App\Providers;
use App\Listeners\MergeCartAfterLogin;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
     /**
     * The event listener mappings for the application.
     */
    protected $listen = [
        \Illuminate\Auth\Events\Login::class => [
            MergeCartAfterLogin::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
