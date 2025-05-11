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
                'front_cover' => 'front-cover.png',
                'book_insights' => 'book-insights.png',
                'full_book' => 'full-book.png',
                'back_cover' => 'back-cover.png',
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

    public function deleteImage(Product $product, string $type)
    {
        if (!in_array($type, ['back_cover', 'full_book'])) {
            abort(403, 'Deletion not allowed for this image type.');
        }

        $image = $product->images->first(function ($img) use ($type) {
            return $img->getType()->value === $type;
        });

        if (!$image) {
            return back()->with('error', 'Image not found.');
        }

        $fullPath = public_path($image->image_path);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }

        $image->delete();

        return back()->with('success', ucfirst(str_replace('_', ' ', $type)) . ' image deleted successfully.');
    }

        public function createAuthor()
    {
        return view('admin.create-author');
    }

    public function storeAuthor(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'birth_date' => 'required|string|max:255',
            'biography' => 'required|string|max:255', 
        ]);

        $validated['id'] = Str::uuid()->toString();

        Author::create($validated);

        return redirect()->route('admin.listing')->with('success', 'Author added.');
    }

}