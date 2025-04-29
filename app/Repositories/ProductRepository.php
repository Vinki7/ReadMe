<?php

namespace App\Repositories;

use App\Enums\Category;
use App\Repositories\Interfaces\IRepository;
use App\Models\Product;
use Illuminate\Support\Collection;

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

    public function productExists(string $productId): bool
    {
        return Product::where('id', $productId)->exists();
    }
}
