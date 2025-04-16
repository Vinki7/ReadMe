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
        return Product::find($id);
    }

    public function getByCategory(string $category, int | null $limit)
    {
        return Product::with('authors')
        ->where('category', $category)
        ->latest()
        ->when($limit, fn ($query) => $query->limit($limit))
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
}
