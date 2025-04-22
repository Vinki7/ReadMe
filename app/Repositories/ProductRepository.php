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

    public function getAllPaginated(int $perPage = 6)
    {
        return Product::with('authors')->paginate($perPage)
        ->through(fn ($product) => new ProductListingDto($product));
    }
}
