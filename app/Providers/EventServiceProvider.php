<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
     /**
     * The event listener mappings for the application.
     */
    protected $listen = [
        Login::class => [
            MergeCartAfterLogin::class,
        ],
    ];

    public function boot(): void
    {
        parent::boot();
    }
}
