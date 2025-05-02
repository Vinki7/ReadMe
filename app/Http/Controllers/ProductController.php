<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Services\ProductService;

class ProductController extends Controller
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

        return view('products.index', compact('products', 'categories', 'authors', 'languages', 'minPrice', 'maxPrice'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = $this->productService->getProductById($id);

        if ($product) {
            return view('products.show', compact('product'));
        }

        return redirect()->route('products.index')->with('error', 'Product not found');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
