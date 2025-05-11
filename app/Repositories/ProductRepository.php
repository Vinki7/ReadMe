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

    public function getByIds(array $ids)
    {
        return Product::with('authors')
            ->whereIn('id', $ids)
            ->get();
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

    public function getAllPaginated($perPage = 6)
    {
        return Product::with('authors')->paginate($perPage)
        ->through(fn ($product) => new ProductListingDto($product));
    }

    public function searchAndSort(array $filters = [], $perPage = 6)
    {
        $query = Product::with('authors');

        if (!empty($filters['search'])) {
            $search = strtolower($filters['search']);
            $query->where(function ($q) use ($search) {
                $q->whereRaw('LOWER(title) LIKE ?', ["%{$search}%"])
                    ->orWhereHas('authors', fn ($q2) => 
                        $q2->whereRaw('LOWER(name) LIKE ?', ["%{$search}%"])
                            ->orWhereRaw('LOWER(surname) LIKE ?', ["%{$search}%"])
                    );
            });
        }
    
        if (!empty($filters['category'])) {
            $query->where('category', $filters['category']);
        }
    
        if (!empty($filters['author'])) {
            $authorFullName = $filters['author'];
            $query->whereHas('authors', function ($q) use ($authorFullName) {
                $q->whereRaw("CONCAT(name, ' ', surname) = ?", [$authorFullName]);
            });
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
    
        return $query->paginate($perPage)
            ->appends($filters)
            ->through(fn ($product) => new \App\DTOs\Product\ProductListingDto($product));
    }

    public function fetchAllCategories() {
        return Product::distinct()->pluck('category');
    }

    public function fetchAllAuthors() {
        return Product::with('authors')->get()->pluck('authors')->flatten()->unique(fn ($author) => $author->name . ' ' . $author->surname)->sortBy('name');
    }

    public function fetchAllLanguages() {
        return Product::distinct()->pluck('language');
    }

    public function fetchMinPrice() {
        return Product::min('price');
    }

    public function fetchMaxPrice() {
        return Product::max('price');
    }
    
    public function productExists(string $productId): bool
    {
        return Product::where('id', $productId)->exists();
    }
}
