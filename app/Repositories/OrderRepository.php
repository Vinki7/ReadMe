<?php

namespace App\Repositories;

use App\Models\Order;
use DB;
use Illuminate\Support\Str;

class OrderRepository
{
    // This class will handle the database operations related to orders.
    // For example, creating an order, updating order status, etc.

    public function createOrder(array $data, array $payment)
    {
        // Transaction to ensure that all database operations are completed successfully - atomicity
        return DB::transaction(function () use ($data, $payment) {
            $orderId = $data['id'] ?? Str::uuid()->toString();

            $order = Order::create([
                'id' => $orderId,
                'delivery_method' => $data['deliveryMethod'],
                'payment_method' => $payment['paymentMethod'],
                'price' => $data['finalPrice'],
                'delivery_address' => json_encode($data['address']),
                'billing_address' => json_encode($data['address']),
                'payment_date' => now(),
                'delivery_date' => now()->addDays(3),
                'expedition_date' => now()->addDays(1),
            ]);

            // Attach the authenticated user to the order
            $order->users()->attach(auth()->user()->id);

            return $order;
        });
    }

    public function getOrderById($id)
    {
        // Logic to retrieve an order by its ID from the database
    }

    public function updateOrderStatus($id, $status)
    {
        // Logic to update the status of an order in the database
    }
}
