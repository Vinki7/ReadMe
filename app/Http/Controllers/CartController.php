<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateCartRequest;
use App\Services\CartService;
use App\Services\ProductService;

class CartController extends Controller
{
    /**
     * The CartService instance used to manage cart-related operations.
     *
     * @var CartService
     */
    private CartService $cartService;

    /**
     * An instance of the ProductService used to handle product-related operations.
     *
     * @var ProductService
     */
    private ProductService $productService;

    /**
     * CartController constructor.
     *
     * @param CartService $cartService Service for handling cart-related operations.
     * @param ProductService $productService Service for handling product-related operations.
     */
    public function __construct(CartService $cartService, ProductService $productService)
    {
        // Initialize the CartService and ProductService instances
        // -> Dependency Injection via registered services in the AppServiceProvider
        $this->cartService = $cartService;
        $this->productService = $productService;
    }

    /**
     * Display the cart page with the list of products, their quantities, and the final price.
     *
     * This method retrieves the items in the cart using the CartService, fetches the full
     * product details for the items in the cart using the ProductService, and calculates
     * the final price of the cart. The data is then passed to the 'cart.index' view.
     *
     * @return \Illuminate\View\View The view displaying the cart page.
     */
    public function index()
    {
        $items = $this->cartService->getCart();

        $listOfIds = $items ? array_keys($items) : [];
        // Fetch full product details
        $products = $this->productService->getListOfProductsByIds($listOfIds); // this should be delegated to the ProductService

        $finalPrice = $this->cartService->getFinalPrice();

        return view('cart.index', compact('products', 'items', 'finalPrice'));
    }


    /**
     * Adds a product to the shopping cart.
     *
     * @param UpdateCartRequest $request The incoming HTTP request containing cart update data.
     * @param string $productId The ID of the product to be added to the cart.
     *
     * @return \Illuminate\Http\RedirectResponse Redirects back to the previous page with a success or error message.
     *
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException If the product with the given ID is not found.
     */
    public function addToCart(UpdateCartRequest $request, string $productId)
    {
        try {
            $quantity = (int) $request->input('quantity');

            $this->cartService->add($productId, $quantity);

        } catch (\Exception $e) {
            logger()->error('Product not found: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Product not found.');
        }

        return redirect()->back()->with('success', 'Item added to cart!');
    }

    /**
     * Updates the quantity of a product in the cart.
     *
     * @param \App\Http\Requests\UpdateCartRequest $request The request object containing the updated quantity.
     * @param string $productId The ID of the product to update in the cart.
     *
     * @return \Illuminate\Http\RedirectResponse Redirects back to the cart page with a success or error message.
     *
     * @throws \Exception If the product is not found or an error occurs during the update process.
     */
    public function update(UpdateCartRequest $request, string $productId)
    {
        try {
            $this->cartService->update($productId, $request->input('quantity'));
        }
        catch (\Exception $e) {
            logger()->error('Product not found: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Product not found.');
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    /**
     * Remove a product from the cart.
     *
     * @param string $productId The ID of the product to be removed.
     * @return \Illuminate\Http\RedirectResponse Redirects back with an error message if the product is not found,
     *                                           or redirects to the cart index with a success message if the item is removed.
     * @throws \Exception If an error occurs during the removal process.
     */
    public function destroy(string $productId)
    {
        try {
            $this->cartService->remove($productId);
        }
        catch (\Exception $e) {
            logger()->error('Product not found: ' . $e->getMessage());

            return redirect()->back()->with('error', 'Product not found.');
        }

        return redirect()->route('cart.index')->with('success', 'Item removed!');
    }
}
