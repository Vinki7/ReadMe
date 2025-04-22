<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService;

    public function __construct(CartService $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index()
    {
        $items = $this->cartService->getItems();

        // Fetch full product details
        $products = Product::whereIn('id', array_keys($items))->get();

        return view('cart.index', compact('products', 'items'));
    }

    public function addToCart(Request $request, string $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity');

        $this->cartService->add($product, $request->input('quantity'));

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    public function update(Request $request, string $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $this->cartService->update($productId, $request->input('quantity'));

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function destroy(string $productId)
    {
        $this->cartService->remove($productId);

        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }


}
