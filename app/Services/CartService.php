<?php

namespace App\Services;

use App\Repositories\ProductRepository;
use App\Repositories\CartRepository;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use Illuminate\Support\Str;

/**
 * Class CartService
 *
 * This service class is responsible for handling operations related to the shopping cart.
 * It provides methods to manage cart items, calculate totals, and perform other cart-related functionalities.
 *
 * @package App\Services
 */
class CartService
{
    /**
     * @var ProductRepository The repository instance used to interact with product data.
     */
    protected ProductRepository $productRepository;

    /**
     * The repository instance for managing cart data.
     *
     * @var CartRepository
     */
    protected CartRepository $cartRepository;

    /**
     * CartService constructor.
     *
     * @param ProductRepository $productRepository The repository for managing product data.
     * @param CartRepository $cartRepository The repository for managing cart data.
     */
    public function __construct(ProductRepository $productRepository, CartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
        $this->productRepository = $productRepository;
    }


    /**
     * Retrieves the session key used to store cart items.
     *
     * @return string The session key for cart items.
     */
    protected function sessionKey(): string
    {
        return 'cart.items';
    }

    /**
     * Adds a product to the cart.
     *
     * Depending on the user's authentication status, the product is either
     * added to the database (for authenticated users) or stored in the session
     * (for guests).
     *
     * @param string $productId The unique identifier of the product to add.
     * @param int $quantity The quantity of the product to add. Defaults to 1.
     * @return void
     */
    public function add(string $productId, int $quantity = 1): void
    {
        if (Auth::check()) {
            $this->addToDatabase($productId, $quantity);
        }

        $this->addToSession($productId, $quantity);
    }

    /**
     * Retrieve the current user's cart as an associative array.
     *
     * If the user is authenticated, the method fetches the cart from the database
     * and includes the associated products. The products are mapped to an array
     * where the keys are product IDs and the values are arrays containing the
     * quantity of each product.
     *
     * If the user is not authenticated, the method retrieves the cart data
     * from the session using a predefined session key.
     *
     * @return array An associative array of cart items, where the keys are product IDs
     *               and the values are arrays containing the quantity of each product.
     */
    public function getCart(): array
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $cart = $this->cartRepository->getCart($userId);

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

    /**
     * Removes a product from the cart.
     *
     * If the user is authenticated, the product is removed from the user's cart
     * in the database using the cart repository. If the user is not authenticated,
     * the product is removed from the session-based cart.
     *
     * @param string $productId The ID of the product to be removed from the cart.
     * @return void
     */
    public function remove(string $productId): void
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $this->cartRepository->removeProduct($userId, $productId);
        }

        $cart = session()->get($this->sessionKey(), []);

        unset($cart[$productId]);

        session()->put($this->sessionKey(), $cart);
    }

    /**
     * Updates the quantity of a product in the cart.
     *
     * If the user is authenticated, the method updates the quantity of the product
     * in the database for the user's cart. If the user is not authenticated, the
     * method updates the quantity of the product in the session-based cart.
     *
     * @param string $productId The ID of the product to update.
     * @param int $quantity The new quantity of the product.
     * @return void
     */
    public function update(string $productId, int $quantity): void
    {
        if (Auth::check()) {
            $this->cartRepository->updateProductQuantity(Auth::id(), $productId, $quantity);
        }

        $cart = session()->get($this->sessionKey(), []);

        // Always store as array with 'quantity' key
        $cart[$productId] = ['quantity' => $quantity];

        session()->put($this->sessionKey(), $cart);
    }

    /**
     * Calculate the final price of all items in the cart.
     *
     * This method retrieves the cart items, calculates the total price
     * by multiplying the product price with its quantity, and returns
     * the final price as a float. If a product in the cart is not found
     * in the repository, an error is logged, and an exception is thrown.
     *
     * @return float The total price of all items in the cart.
     *
     * @throws \Exception If a product in the cart is not found.
     */
    public function getFinalPrice(): float
    {
        $items = $this->getCart();
        $finalPrice = 0;

        foreach ($items as $productId => $data) {
            $product = $this->productRepository->getById($productId);

            if ($product) {
                $finalPrice += $product->price * ($data['quantity'] ?? 1);
            } else {
                logger()->error('Product not found in cart: ' . $productId);

                throw new \Exception('Product not found in cart: ' . $productId);
            }
        }

        return $finalPrice;
    }

    /**
     * * Merges the session cart into the authenticated user's cart.
     *
     * This method checks if the user is authenticated and if there is a session cart.
     * If both conditions are met, it attempts to merge the session cart into the user's cart
     * using the cart repository. If an error occurs during the process, it logs the error.
     * After successfully merging, the session cart is cleared.
     *
     * @return void
     *
     * @throws \Exception If the user is not authenticated.
     */
    public function mergeSessionToUser(): void
    {
        if (!Auth::check())
        {
            return;
        }

        $sessionCart = session()->get($this->sessionKey(), []);

        if (empty($sessionCart))
        {
            return;
        }

        try {
            $userId = Auth::id();

            $this->cartRepository->updateWithSession($userId, $sessionCart);
        }
        catch (\Exception $e) {
            logger()->error('Error merging session cart to user cart: ' . $e->getMessage());
            return;
        }

        session()->forget($this->sessionKey());

        return;
    }

    private function loadCartToSession(): void
    {
        if (!Auth::check()) {
            throw new \Exception('User is not authenticated.');
        }

        try {
            $userId = Auth::id();

            $userCart = $this->cartRepository->getCart($userId);

            foreach ($userCart->products() as $product) {
                $this->addToSession($product->id, $product->pivot->quantity);
            }
        } catch (\Exception $e) {
            logger()->error('Error loading cart to session: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Clears the user's cart.
     *
     * If the user is authenticated, the method clears the cart in the database.
     * If the user is not authenticated, it clears the session-based cart.
     *
     * @param string $userId The ID of the user whose cart is to be cleared.
     * @return void
     */
    public function clearCart(): void
    {
        if (Auth::check()) {
            $userId = Auth::id();

            $this->cartRepository->clearCart($userId);
        }

        session()->forget($this->sessionKey());
    }

    /**
     * Adds a product to the user's cart in the database.
     *
     * @param string $productId The ID of the product to add.
     * @param int $quantity The quantity of the product to add.
     *
     * @throws \Exception If the product does not exist or the user is not authenticated.
     *
     * This method checks if the product exists in the repository. If the product is not found,
     * an exception is thrown. It also ensures that the user is authenticated before proceeding.
     * If the product already exists in the user's cart, the quantity is updated by adding the
     * new quantity to the existing quantity. Otherwise, the product is added to the cart with
     * the specified quantity.
     */
    private function addToDatabase(string $productId, int $quantity): void
    {
        if (!$this->productRepository->productExists($productId)) {
            throw new \Exception('Product not found: ' . $productId);
        }

        $userId = Auth::id();

        if (!$userId)
        {
            throw new \Exception('User not authenticated');
        }

        $existingProduct = $this->cartRepository->getProductById($userId, $productId);

        if ($existingProduct !== null) {
            $currentQuantity = $existingProduct->pivot->quantity ?? 0;

            $newQuantity = $currentQuantity + $quantity;

            $this->cartRepository->updateProductQuantity($userId, $productId, $newQuantity);
        } else {
            $this->cartRepository->addProduct($userId, $productId, $quantity);
        }
    }

    /**
     * Adds a product to the session cart or updates its quantity if it already exists.
     *
     * @param string $productId The unique identifier of the product to add or update.
     * @param int $quantity The quantity of the product to add to the cart.
     *
     * @return void
     */
    private function addToSession(string $productId, int $quantity): void
    {
        $cart = session()->get($this->sessionKey(), []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity'] += $quantity;
        } else {
            $cart[$productId] = [
                'quantity' => $quantity,
            ];
        }

        session()->put($this->sessionKey(), $cart);
    }
}
