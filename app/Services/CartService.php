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

            // Check if product already exists in cart
            $existing = $cart->products()->where('product_id', $product->id)->first();

            if ($existing) {
                $currentQuantity = $existing->pivot->quantity;
                $cart->products()->updateExistingPivot($product->id, [
                    'total_amount' => $currentQuantity + $quantity
                ]);
            } else {
                $cart->products()->attach($product->id, ['quantity' => $quantity]);
            }

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
            $cart = Cart::where('user_id', Auth::id())->with('products')->first(); // this could be delegated to the CartRepository

            if ($cart) {
                return $cart->products->mapWithKeys(function ($product) {
                    return [
                        $product->id => ['quantity' => $product->pivot->quantity],
                    ];
                })->toArray();
            }

            return [];
        }

        return session()->get($this->sessionKey(), []);
    }

    public function remove(string $productId): void
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->first(); // this could be delegated to the CartRepository
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

            // Always store as array with 'quantity' key
            $cart[$productId] = ['quantity' => $quantity];

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

        foreach ($sessionCart as $productId => $data) {
            $quantity = is_array($data) ? ($data['quantity'] ?? 1) : $data;

            $existing = $cart->products()->where('product_id', $productId)->first();

            if ($existing) {
                $currentQty = $existing->pivot->quantity ?? 0;
                $cart->products()->updateExistingPivot($productId, [
                    'quantity' => $currentQty + $quantity
                ]);
            } else {
                $cart->products()->attach($productId, ['quantity' => $quantity]);
            }
        }

        session()->forget($this->sessionKey());
    }
}
