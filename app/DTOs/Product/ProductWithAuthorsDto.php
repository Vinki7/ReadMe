<?php

namespace App\DTOs\Product;

use App\Models\Product;

class ProductWithAuthorsDto
{
    public string $id;
    public string $title;
    public string $description;
    public float $price;
    public int $stock;
    public string $category;
    public array $authors;

    public function __construct(Product $product) {
        $this->id = $product->id;
        $this->title = $product->title;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->stock = $product->stock;
        $this->category = $product->category->value;
        $this->authors = $product->authors->map(function ($author) {
            return "{$author->name} {$author->surname}";
        })->toArray();
    }
}
