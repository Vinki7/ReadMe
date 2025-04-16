<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Enums\Category;

class Product extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'stock',
        'category',
    ];

    protected $casts = [
        'id' => 'string',
        'price' => 'decimal:2',
        'category' => Category::class,
    ];

    // Relationship with authors (many-to-many)
    public function authors()
    {
        return $this->belongsToMany(Author::class, 'product_authors', 'product_id', 'author_id');
    }

    // Relationship with carts (many-to-many)
    public function carts()
    {
        return $this->belongsToMany(Cart::class, 'cart_products', 'product_id', 'cart_id')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    // Relationship with orders (many-to-many)
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_products', 'product_id', 'order_id')
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
}
