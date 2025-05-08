<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Product;

class AdminController extends Controller
{
    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    
    public function index(Request $request)
    {
        $products = $this->productService->getAllFilteredAndSorted($request->all());

        $categories = $this->productService->getAllCategories();
        $authors = $this->productService->getAllAuthors();
        $languages = $this->productService->getAllLanguages();

        $minPrice = $this->productService->getMinPrice();
        $maxPrice = $this->productService->getMaxPrice();

        return view('admin.admin-listing', compact('products', 'categories', 'authors', 'languages', 'minPrice', 'maxPrice'));
    }

    public function edit(Product $product)
    {
        return view('admin.edit', compact('product'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.listing')->with('success', 'Product deleted successfully.');
    }
}
