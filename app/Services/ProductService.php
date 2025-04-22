<?php

namespace App\Services;

use App\DTOs\Product\ProductListingDto;
use App\DTOs\Product\ProductDetailsDto;
use App\Enums\Category;
use App\Repositories\ProductRepository;
use Illuminate\Support\Collection;

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

    public function getProductById(string $id): ?ProductDetailsDto
    {
        $product = $this->productRepository->getById($id);

        if ($product) {
            return new ProductDetailsDto($product);
        }

        return null;
    }

    public function getLimitedProductsByCategory(Category $category, int $limit = 3): Collection
    {
        return $this->productRepository->getByCategory($category->value, $limit)
            ->map(function ($product) {
                return new ProductListingDto($product);
            });
    }

    public function getListOfProductsByIds(array $ids): Collection
    {
        $products = $this->productRepository->getByIds($ids);

        if ($products->isEmpty()) {
            return collect();
        }

        return $products->map(function ($product): ProductListingDto {
            return new ProductListingDto($product);
        });
    }
}
