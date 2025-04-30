<?php

namespace App\Http\Controllers;

use App\Enums\DeliveryMethod;
use App\Enums\PaymentMethod;
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

    /**
     * Display the address form for the checkout process.
     *
     * This method retrieves the current cart using the cart service.
     * If the cart is empty, the user is redirected to the cart index page
     * with an error message. Otherwise, it returns the view for the
     * address form.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function address()
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $deliveryMethods = [
            DeliveryMethod::Standard->value,
            DeliveryMethod::Express->value,
            DeliveryMethod::Pickup->value
        ];

        return view('cart.address', compact('deliveryMethods'));
    }

    /**
     * Handles the checkout request by processing the address
     * and redirecting the user to the payment step.
     *
     * @param \Illuminate\Http\Request $request The incoming HTTP request containing checkout data.
     * @return \Illuminate\Http\RedirectResponse Redirects to the checkout payment route.
     */
    public function handleRequest(Request $request)
    {
        $this->checkoutService->handleAddress($request);

        return redirect()->route('checkout.payment');
    }

    /**
     * Handles the payment process for the user's cart.
     *
     * This method retrieves the current cart using the cart service. If the cart is empty,
     * the user is redirected to the cart index page with an error message. It then prepares
     * the cart details using the checkout service. If no products are found in the cart,
     * the user is redirected to the cart index page with an error message. Otherwise, it
     * returns the payment view with the prepared cart details.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function payment()
    {
        $cart = $this->cartService->getCart();

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $cartDetails = $this->checkoutService->prepareCartDetails();

        if (empty($cartDetails['products'])) {
            return redirect()->route('cart.index')->with('error', 'No products found in your cart.');
        }

        return view('cart.payment')->with($cartDetails);
    }

    /**
     * Process the payment and place the order.
     *
     * This method handles the payment process, places the order, and clears the cart
     * upon successful completion. It also redirects the user to the home page with
     * a success message.
     *
     * @param \Illuminate\Http\Request $request The HTTP request containing payment details.
     * @return \Illuminate\Http\RedirectResponse Redirects to the home page with a success message.
     */
    public function processPayment(Request $request)
    {
        if ($request->input('paymentMethod') == PaymentMethod::CashOnDelivery->value) {
            $this->checkoutService->placeOrder(
                [
                    'paymentMethod' => $request->input('paymentMethod')
                ]
            );
        } else {
            $validated = $this->checkoutService->handlePayment($request);
            $validated['paymentMethod'] = $request->input('paymentMethod');

            try {
                $this->checkoutService->placeOrder($validated);

                $this->cartService->clearCart();
            }
            catch (\Exception $e) {
                return redirect()->route('cart.index')->with('error', 'An error occurred while processing your order. Please try again.');
            }
        }

        return redirect()->route('home.index')->with('success', 'Your order has been placed successfully!');
    }
}
