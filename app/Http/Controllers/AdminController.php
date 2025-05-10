<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Models\Product;
use App\Models\Author;
use App\Models\ProductImage;
use App\Enums\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

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
        $allAuthors = Author::all();
        $categories = Category::cases();
        return view('admin.edit', compact('product', 'allAuthors', 'categories'));
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.listing')->with('success', 'Product deleted successfully.');
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'publisher' => 'nullable|string',
            'isbn' => 'nullable|string|max:255',
            'publication_date' => 'nullable|date',
            'language' => 'nullable|string|max:255',
            'authors' => 'required|array',
            'authors.*' => 'exists:authors,id',

            'images.front-cover' => 'nullable|image|mimes:png',
            'images.book-insights' => 'nullable|image|mimes:png',
            'images.full-book' => 'nullable|image|mimes:png',
            'images.back-cover' => 'nullable|image|mimes:png',
        ]);

        // Set directory name if not already set
        if (!$product->directory) {
            $product->directory = Str::slug($product->title);
        }

        $product->update($validated);
        $product->save(); // save directory if it was set above
        $product->authors()->sync($validated['authors']);

        // Build path to directory
        $folder = "images/products/{$product->directory}";
        File::ensureDirectoryExists(public_path($folder));

        foreach ($request->file('images', []) as $key => $file) {
            $filename = match ($key) {
                'front-cover' => 'front-cover.png',
                'book-insights' => 'book-insights.png',
                'full-book' => 'full-book.png',
                'back-cover' => 'back-cover.png',
                default => null
            };

            if ($filename) {
                $relativePath = "$folder/$filename";
                $fullPath = public_path($relativePath);

                // Move uploaded image (will overwrite if exists)
                $file->move(public_path($folder), $filename);

                // If image already exists in DB, no need to insert again
                $existing = ProductImage::where('product_id', $product->id)
                                        ->where('image_path', $relativePath)
                                        ->first();

                if (!$existing) {
                    ProductImage::create([
                        'id' => Str::uuid()->toString(),
                        'product_id' => $product->id,
                        'image_path' => $relativePath,
                    ]);
                }
            }
        }

        return redirect()->route('admin.listing')->with('success', 'Product updated.');
    }
}
