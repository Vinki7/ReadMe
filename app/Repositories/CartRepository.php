<?php

namespace App\Repositories;

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

/**
 * Class CartRepository
 *
 * This class is responsible for managing the operations related to the shopping cart.
 * It provides methods to interact with the cart data, such as adding, removing,
 * and retrieving items from the cart.
 *
 * @package App\Repositories
 */
class CartRepository
{
    /**
     * Retrieve the cart for the specified user or create a new one if it does not exist.
     *
     * @param string $userId The ID of the user for whom the cart is being retrieved.
     *
     * @throws \Exception If the user is not authenticated.
     *
     * @return \App\Models\Cart The retrieved or newly created cart instance.
     */
    public function getCart(string $userId)
    {
        if (!Auth::check()) {
            throw new \Exception('User not authenticated');
        }

        $cart = Cart::firstOrCreate(
            ['user_id' => Auth::id()], // get first where user_id is Auth::id()
            ['id' => Str::uuid(), 'user_id' => $userId, 'total_amount' => 0] // create a new cart if not exists
        );

        return $cart;
    }

    /**
     * Adds a product to the user's cart.
     *
     * @param int $userId The ID of the user whose cart is being updated.
     * @param int $productId The ID of the product to add to the cart.
     * @param int $quantity The quantity of the product to add.
     *
     * @return void
     *
     * @throws \Exception If the cart or product cannot be retrieved or updated.
     */
    public function addProduct($userId, $productId, $quantity)
    {
        // Logic to add product to the user's cart in the database
        $cart = $this->getCart($userId);

        $cart->products()->attach($productId, ['quantity' => $quantity]);

        $this->updateTotalAmount($cart);
    }

    /**
     * Updates the user's cart with the provided session cart data.
     *
     * This method retrieves the user's cart and synchronizes it with the session cart.
     * If a product already exists in the cart, its quantity is updated by adding the
     * quantity from the session cart. If the product does not exist, it is added to
     * the cart with the specified quantity.
     *
     * @param string $userId The ID of the user whose cart is being updated.
     * @param array $sessionCart An associative array representing the session cart.
     *                            The keys are product IDs, and the values are either
     *                            integers (quantities) or arrays containing a 'quantity' key.
     *
     * @return void
     */
    public function updateWithSession(string $userId, Array $sessionCart)
    {
        $cart = $this->getCart($userId);

        foreach ($sessionCart as $productId => $data) {
            $quantity = is_array($data) ? ($data['quantity'] ?? 1) : $data;

            $existing = $cart->products()->where('product_id', $productId)->first();

            if ($existing) {
                $currentQuantity = $existing->pivot->quantity ?? 0;

                $cart->products()->updateExistingPivot($productId, [
                    'quantity' => $currentQuantity + $quantity
                ]);
            } else {
                $cart->products()->attach($productId, ['quantity' => $quantity]);
            }
        }

        $this->updateTotalAmount($cart);
    }

    /**
     * Remove a product from the user's cart.
     *
     * This method removes a specified product from the user's cart in the database,
     * updates the total amount of the cart by subtracting the price of the removed product,
     * and saves the updated cart.
     *
     * @param int $userId The ID of the user whose cart is being modified.
     * @param int $productId The ID of the product to be removed from the cart.
     * @return void
     */
    public function removeProduct($userId, $productId)
    {
        // Logic to remove product from the user's cart in the database
        $cart = $this->getCart($userId);
        $productPrice = $cart->products()->find($productId)->price;

        $cart->products()->detach($productId);
        // $cart->total_amount -= $productPrice; // Assuming price is a field in the products table
        $this->updateTotalAmount($cart);
    }

    /**
     * Retrieves a specific product from the user's cart.
     *
     * @param int $userId The ID of the user whose cart is being accessed.
     * @param int $productId The ID of the product to retrieve.
     *
     * @return \App\Models\Product|null The product instance if found, null otherwise.
     */
    public function getProductById($userId, $productId)
    {
        $cart = $this->getCart($userId);

        if (!$cart) {
            return null;
        }

        return $cart->products()->where('product_id', $productId)->withPivot('quantity')->first();
    }

    /**
     * Updates the quantity of a specific product in the user's cart.
     *
     * @param int $userId The ID of the user whose cart is being updated.
     * @param int $productId The ID of the product whose quantity is being updated.
     * @param int $newQuantity The new quantity of the product.
     *
     * @throws \Exception If the cart is not found or if the update operation fails.
     *
     * @return void
     */
    public function updateProductQuantity($userId, $productId, $newQuantity)
    {
        // Logic to update the quantity of a specific product in the user's cart in the database
        $cart = $this->getCart($userId);

        if (!$cart) {
            throw new \Exception('Cart not found');
        }

        try {
            $cart->products()->updateExistingPivot($productId, ['quantity' => $newQuantity]);
        }
        catch (\Exception $e) {
            throw new \Exception('Failed to update product quantity');
        }

        $this->updateTotalAmount($cart);
    }

    /**
     * Clears the cart for the specified user by detaching all products,
     * resetting the total amount to zero, and saving the changes.
     *
     * @param int $userId The ID of the user whose cart needs to be cleared.
     *
     * @throws \Exception If the cart is not found for the given user ID.
     */
    public function clearCart($userId)
    {
        $cart = $this->getCart($userId);

        if ($cart) {
            $cart->products()->detach();
            $cart->total_amount = 0;
            $cart->save();
        } else {
            throw new \Exception('Cart not found');
        }
    }

    /**
     * Updates the total amount of the given cart by calculating the sum of
     * the prices of all products multiplied by their respective quantities.
     *
     * @param \App\Models\Cart $cart The cart instance whose total amount needs to be updated.
     *
     * @return void
     */
    private function updateTotalAmount($cart)
    {
        $total = $cart->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        $cart->total_amount = $total;

        $cart->save();
    }
}
