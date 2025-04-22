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

    public function searchAndSort(?string $search = null, ?string $sort = null)
    {
        $query = Product::with('authors');

        if (!empty($search)) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'LIKE', '%' . $search . '%')
                  ->orWhereHas('authors', fn ($authorQ) =>
                      $authorQ->where('name', 'LIKE', '%' . $search . '%')
                );
            });
        }

    
        match ($sort) {
            'name_asc' => $query->orderBy('title', 'asc'),
            'name_desc' => $query->orderBy('title', 'desc'),
            'price_asc' => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            default => null,
        };

        return $query->paginate($this->perPage)
            ->appends(['search' => $search, 'sort' => $sort])
            ->through(fn ($product) => new ProductListingDto($product));
    }
}
