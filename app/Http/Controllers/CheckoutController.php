<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\CheckoutService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private CartService $cartService;
    private CheckoutService $checkoutService;

    public function __construct(CartService $cartService, CheckoutService $checkoutService)
    {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
    }

    public function address(Request $request)
    {
        $cart = $this->cartService->getItems();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        return view('cart.address');
    }

    public function handleRequest(Request $request)
    {
        // Validate the request data
        // If validation fails, an excetion will be thrown and handled by the framework
        // If validation passes, the validated data will be returned
        $validated = $this->checkoutService->handleAddress($request);

        // Store the validated address in the session
        session()->put('checkout.address', $validated);

        return redirect()->route('checkout.payment');
    }

    public function payment()
    {
        $cart = $this->cartService->getItems();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $finalPrice = $this->cartService->getFinalPrice();

        return view('cart.payment')->with([
            'cart' => $cart,
            'address' => session('checkout.address'),
            'finalPrice' => $finalPrice,
        ]);
    }

    public function processPayment(Request $request)
    {
        $validated = $this->checkoutService->handlePayment($request);

        // Optional: Validate/Use session('checkout.address') info

        // Simulate order placement
        // Save to DB or trigger payment gateway

        // Clear cart if successful
        session()->forget('cart.items');

        return redirect()->route('home.index')->with('success', 'Your order has been placed successfully!');
    }
}
