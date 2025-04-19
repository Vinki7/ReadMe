<?php

namespace App\DTOs\Product;

use App\Models\Product;
use Laravel\Pail\ValueObjects\Origin\Console;

class ProductListingDto
{
    public string $id;
    public string $title;
    public string $description;
    public float $price;
    public int $stock;
    public string $category;
    public array $authors;
    public string $frontCover;

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
        $this->frontCover = $product->frontCover()->image_path ?? "";
    }
}
