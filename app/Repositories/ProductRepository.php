<?php

namespace App\Repositories;

use App\Enums\Category;
use App\Repositories\Interfaces\IRepository;
use App\Models\Product;
use Illuminate\Support\Collection;
use App\DTOs\Product\ProductListingDto;

class ProductRepository implements IRepository
{
    public function getAll()
    {
        return Product::all();
    }

    public function getById($id)
    {
        $result = Product::with('authors')
        ->where('id', $id)
        ->first();

        return $result;
    }

    public function getByCategory(string $category, int | null $limit)
    {
        $result = Product::with('authors')
        ->where('category', $category)
        ->latest()
        ->when($limit, fn ($query) => $query->limit($limit))
        ->get();

        return $result;
    }

    public function create(array $data)
    {
        return Product::create($data);
    }

    public function update($id, array $data)
    {
        $product = Product::find($id);
        if ($product) {
            $product->update($data);
            return $product;
        }
        return null;
    }

    public function delete($id)
    {
        $product = Product::find($id);
        if ($product) {
            $product->delete();
            return true;
        }
        return false;
    }

    private $perPage = 6;
    public function getAllPaginated()
    {
        return Product::with('authors')->paginate($this->perPage)
        ->through(fn ($product) => new ProductListingDto($product));
    }

    public function searchAndSort(array $filters = [])
    {
        $query = Product::with('authors');

        if (!empty($filters['search'])) {
            $search = $filters['search'];
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', "%{$search}%")
                  ->orWhereHas('authors', fn ($q2) => $q2->where('name', 'LIKE', "%{$search}%"));
            });
        }
    
        if (!empty($filters['genre'])) {
            $query->where('genre', $filters['genre']);
        }
    
        if (!empty($filters['author'])) {
            $author = $filters['author'];
            $query->whereHas('authors', fn ($q) => $q->where('name', $author));
        }
    
        if (!empty($filters['language'])) {
            $query->where('language', $filters['language']);
        }
    
        if (!empty($filters['min_price'])) {
            $query->where('price', '>=', $filters['min_price']);
        }
    
        if (!empty($filters['max_price'])) {
            $query->where('price', '<=', $filters['max_price']);
        }
    
        match ($filters['sort'] ?? null) {
            'name_asc' => $query->orderBy('title', 'asc'),
            'name_desc' => $query->orderBy('title', 'desc'),
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default => null,
        };
    
        return $query->paginate($this->perPage)
            ->appends($filters)
            ->through(fn ($product) => new \App\DTOs\Product\ProductListingDto($product));
    }
}
