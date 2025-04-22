<?php

namespace App\Listeners;

use App\Services\CartService;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Events\Login;

class MergeCartAfterLogin
{
    public function handle(Login $event)
    {
        app(CartService::class)->mergeSessionToUser();
        Log::debug('Cart merged after login for user: ' . $event->user->id);

        session()->flash('cart_merged', 'Cart successfully merged after login!');

    }
}
