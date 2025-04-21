<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Str;

class CartService
{
    protected function sessionKey(): string
    {
        return 'cart.items';
    }

    public function add(Product $product, int $quantity = 1): void
    {
        if (Auth::check()) {
            $cart = Cart::firstOrCreate(
                ['user_id' => Auth::id()],
                ['id' => Str::uuid(), 'total_amount' => 0]
            );

            $cart->products()->syncWithoutDetaching([
                $product->id => ['quantity' => $quantity]
            ]);

        } else {
            $cart = session()->get($this->sessionKey(), []);

            if (isset($cart[$product->id])) {
                $cart[$product->id] += $quantity;
            } else {
                $cart[$product->id] = $quantity;
            }

            session()->put($this->sessionKey(), $cart);
        }
    }

    public function getItems(): array
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->with('products')->first();
            return $cart?->products->mapWithKeys(fn ($p) => [$p->id => $p->pivot->quantity])->toArray() ?? [];
        }

        return session()->get($this->sessionKey(), []);
    }

    public function remove(string $productId): void
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            $cart?->products()->detach($productId);
        } else {
            $cart = session()->get($this->sessionKey(), []);
            unset($cart[$productId]);
            session()->put($this->sessionKey(), $cart);
        }
    }

    public function update(string $productId, int $quantity): void
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first();
            if ($cart && $cart->products()->where('product_id', $productId)->exists()) {
                $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
            }
        } else {
            $cart = session()->get($this->sessionKey(), []);
            $cart[$productId] = $quantity;
            session()->put($this->sessionKey(), $cart);
        }
    }

    public function mergeSessionToUser(): void
    {
        if (!Auth::check()) return;

        $sessionCart = session()->get($this->sessionKey(), []);
        if (empty($sessionCart)) return;

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()],
            ['id' => Str::uuid(), 'total_amount' => 0]
        );

        foreach ($sessionCart as $productId => $qty) {
            $cart->products()->syncWithoutDetaching([
                $productId => ['quantity' => $qty]
            ]);
        }

        session()->forget($this->sessionKey());
    }
}
