<?php

namespace App\DTOs\Product;

use App\Enums\ImageType;
use App\Models\Product;
use App\Models\ProductImage;

class ProductDetailsDto {
    public string $id;
    public string $title;
    public string $description;
    public float $price;
    public int $stock;
    public string $category;
    public array $authors;
    public ?ProductImage $frontCover = null;
    public ?ProductImage $backCover = null;
    public ?ProductImage $fullBook = null;
    public ?ProductImage $bookInsights = null;

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

        $productImages = $product->allImages()->all();
        $this->assignImages($productImages);
    }

    private function assignImages($images): void
    {
        $this->frontCover = $this->getByType($images, ImageType::FrontCover);
        $this->backCover = $this->getByType($images, ImageType::BackCover);
        $this->fullBook = $this->getByType($images, ImageType::FullBook);
        $this->bookInsights = $this->getByType($images, ImageType::BookInsights);
    }

    private function getByType($images, ImageType $imageType): ?ProductImage
    {
        foreach ($images as $image) {
            if ($image->getType() === $imageType) {
                return $image;
            }
        }

        return null;
    }
}
