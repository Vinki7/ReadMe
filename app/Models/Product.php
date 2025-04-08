<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $keyType = 'string';
    public $incrementing = false;

    public function images() {
        return $this->hasMany(ProductImage::class);
    }

    public function authors() {
        return $this->belongsToMany(Author::class, 'product_authors');
    }

    public function carts() {
        return $this->belongsToMany(Cart::class, 'cart_products')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    public function orderHistories() {
        return $this->hasMany(OrderHistory::class);
    }
}
