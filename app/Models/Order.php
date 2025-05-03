<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'user_id',
        'delivery_method',
        'payment_method',
        'price',
        'delivery_address',
        'billing_address',
        'payment_date',
        'delivery_date',
        'expedition_date',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_orders', 'order_id', 'user_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_products', 'order_id', 'product_id')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
