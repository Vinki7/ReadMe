<?php

namespace App\Services;

use Illuminate\Http\Request;

class CheckoutService
{
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

        return $validated;
    }

    public function handlePayment(Request $request)
    {

        $validated = $request->validate([
            'cardName' => 'required|string|max:255',
            'cardNumber' => 'required|numeric|digits_between:13,19',
            'expiryDate' => 'required|string',
            'cvv' => 'required|numeric|digits:3',
            'deliveryMethod' => 'required|in:post,courier',
        ]);

        return $validated;
    }
}
