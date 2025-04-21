<?php

namespace App\Listeners;

use App\Services\CartService;

class MergeCartAfterLogin
{
    public function handle($event)
    {
        app(CartService::class)->mergeSessionToUser();
    }
}
