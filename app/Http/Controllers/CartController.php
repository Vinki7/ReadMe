<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\CartService;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;

class CartController extends Controller
{
    private CartService $cartService;
    private ProductService $productService;

    public function __construct(CartService $cartService, ProductService $productService)
    {
        // CartService and ProductService are injected via the constructor => Dependency Injection
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    public function index()
    {
        $items = $this->cartService->getItems();

        $listOfIds = $items ? array_keys($items) : [];
        // Fetch full product details
        $products = $this->productService->getListOfProductsByIds($listOfIds); // this should be delegated to the ProductService

        return view('cart.index', compact('products', 'items'));
    }

    public function addToCart(Request $request, string $productId)
    {
        $request->validate(['quantity' => 'required|integer|min:1']);

        $product = Product::findOrFail($productId);
        $quantity = $request->input('quantity');

        $this->cartService->add($product, $quantity);

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
