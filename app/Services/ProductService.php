<?php

namespace App\Services;

use App\Enums\Category;
use App\Repositories\ProductRepository;
use Illuminate\Support\Collection;
use App\DTOs\Product\ProductWithAuthorsDto;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $repository)
    {
        $this->productRepository = $repository;
    }

    public function getAllProducts(): Collection
    {
        return $this->productRepository->getAll();
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function getLimitedProductsByCategory(Category $category, int $limit = 3): Collection
    {
        return $this->productRepository
            ->getByCategory($category->value, $limit)
            ->map(function ($product) {
                return new ProductWithAuthorsDto($product);
            });
    }
}
