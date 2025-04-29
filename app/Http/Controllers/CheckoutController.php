<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Services\CheckoutService;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    private CartService $cartService;
    private CheckoutService $checkoutService;
    private ProductService $productService;

    public function __construct(CartService $cartService, CheckoutService $checkoutService, ProductService $productService)

    {
        $this->cartService = $cartService;
        $this->checkoutService = $checkoutService;
        $this->productService = $productService;
    }

    public function address(Request $request)
    {
        $cart = $this->cartService->getCart();

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
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $finalPrice = $this->cartService->getFinalPrice();

        $items = $this->cartService->getCart();
        $listOfIds = $items ? array_keys($items) : [];
        $products = $this->productService->getListOfProductsByIds($listOfIds); // this should be delegated to the ProductService

        if (empty($products)) {
            return redirect()->route('cart.index')->with('error', 'No products found in your cart.');
        }

        return view('cart.payment')->with([
            'products' => $products,
            'address' => session('checkout.address'),
            'finalPrice' => $finalPrice,
            'cart' => $cart,
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
