<?php

namespace App\Services;

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

    public function getProductById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function getLimitedProducts(int $limit): Collection
    {
        return $this->productRepository->getAll()->take($limit);
    }
}
