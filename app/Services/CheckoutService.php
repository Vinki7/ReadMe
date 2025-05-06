<?php

namespace App\Services;

use App\Enums\Role;
use App\Repositories\OrderRepository;
use Date;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Repositories\UserRepository;

class CheckoutService
{
    private CartService $cartService;
    private ProductService $productService;
    private OrderRepository $orderRepository;
    private UserRepository $userRepository;

    public function __construct(CartService $cartService, ProductService $productService, OrderRepository $orderRepository, UserRepository $userRepository)
    {
        $this->cartService = $cartService;
        $this->productService = $productService;
        $this->orderRepository = $orderRepository;
        $this->userRepository = $userRepository;
    }

    public function handleAddress(Request $request)
    {
        $validated = $request->validate([
            'fullName' => 'required|string|max:255',
            'eMial' => 'required|email',
            'streetAddress' => 'required|string',
            'city' => 'required|string',
            'postalCode' => 'required|string',
            'country' => 'required|string',
        ]);

        session()->put('checkout.address', $validated);
        session()->put('checkout.deliveryMethod', request()->input('deliveryMethod'));
    }

    public function handlePayment(Request $request)
    {
        $validated = $request->validate([
            'cardName' => 'required|string|max:255',
            'cardNumber' => 'required|numeric|digits_between:13,19',
            'expiryDate' => [
                'required',
                'regex:/^(0[1-9]|1[0-2])\/\d{2}$/', // Matches MM/YY format
                function ($attribute, $value, $fail) {
                    [$month, $year] = explode('/', $value);
                    $currentYear = now()->format('y'); // Last two digits of the year
                    $currentMonth = now()->format('m');

                    if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
                        $fail('The ' . $attribute . ' must be a valid future date.');
                    }
                },
            ],
            'cvv' => 'required|numeric|digits:3',
        ]);

        return $validated;
    }

    public function prepareCartDetails(): array
    {
        $cart = $this->cartService->getCart();
        $finalPrice = $this->cartService->getFinalPrice();

        $listOfIds = $cart ? array_keys($cart) : [];
        $products = $this->productService->getListOfProductsByIds($listOfIds);

        return [
            'products' => $products,
            'address' => session('checkout.address'),
            'finalPrice' => $finalPrice,
            'deliveryMethod' => session('checkout.deliveryMethod'),
            'cart' => $cart,
        ];
    }

    public function placeOrder(array $validatedPaymentData)
    {
        $cartDetails = $this->prepareCartDetails();

        $userId = Auth::check() ? Auth::user()->id : null;

        $this->orderRepository->createOrder($cartDetails, $validatedPaymentData, $userId);

        $this->cartService->clearCart();
        session()->forget('checkout.address');
        session()->flash('success', 'Your order has been placed successfully.');
    }
}
