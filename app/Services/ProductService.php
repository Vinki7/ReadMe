<?php

namespace App\Services;

use App\DTOs\Product\ProductListingDto;
use App\DTOs\Product\ProductDetailsDto;
use App\Enums\Category;
use App\Repositories\ProductRepository;
use Illuminate\Support\Collection;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductService
{
    protected ProductRepository $productRepository;

    public function __construct(ProductRepository $repository)
    {
        $this->productRepository = $repository;
    }
    
    public function getAllProducts(): LengthAwarePaginator
    {
        return $this->productRepository->getAllPaginated();
    }

    public function getAllFilteredAndSorted(array $filters = [])
    {
        return $this->productRepository->searchAndSort($filters);
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

    public function getAllCategories()  {
        return $this->productRepository->fetchAllCategories();
    }

    public function getAllAuthors() {
        return $this->productRepository->fetchAllAuthors();
    }

    public function getAllLanguages() {
        return $this->productRepository->fetchAllLanguages();
    }

    public function getMinPrice() {
        return $this->productRepository->fetchMinPrice();
    }

    public function getMaxPrice() {
        return $this->productRepository->fetchMaxPrice();
    }
}
