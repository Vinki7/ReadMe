@extends('layouts.app')
@section('title', 'Edit Product')

@section('content')
<main class="container py-5">
    <h1 class="mb-4">Edit Product: {{ $product->title }}</h1>

    <form method="POST" action="{{ route('admin.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" value="{{ old('title', $product->title) }}" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description', $product->description) }}</textarea>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price (€)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="form-control" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->value }}" 
                        {{ $product->category->value === $category->value ? 'selected' : '' }}>
                        {{ ucfirst(strtolower($category->name)) }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Authors -->
        <div class="mb-3">
            <label class="form-label">Authors</label>
            <select name="authors[]" class="form-control" multiple required>
                @foreach($allAuthors as $author)
                    <option value="{{ $author->id }}" 
                        {{ $product->authors->contains($author->id) ? 'selected' : '' }}>
                        {{ $author->name }} {{ $author->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Publisher -->
        <div class="mb-3">
            <label class="form-label">Publisher</label>
            <input name="publisher" value="{{ old('publisher', $product->publisher) }}" class="form-control">
        </div>

        <!-- ISBN -->
        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input name="isbn" value="{{ old('isbn', $product->isbn) }}" class="form-control">
        </div>

        <!-- Publication Date -->
        <div class="mb-3">
            <label class="form-label">Publication Date</label>
            <input type="date" name="publication_date" value="{{ old('publication_date', $product->publication_date?->format('Y-m-d')) }}" class="form-control">
        </div>

        <!-- Language -->
        <div class="mb-3">
            <label class="form-label">Language</label>
            <input name="language" value="{{ old('language', $product->language) }}" class="form-control">
        </div>

        <hr>
        <h4>Images</h4>

        @php
            $images = $product->images->keyBy(fn($img) => $img->getType()->value);
        @endphp

        @foreach (['front_cover', 'book_insights', 'full_book', 'back_cover'] as $imageKey)
            <div class="mb-3">
                <label class="form-label text-capitalize">{{ str_replace('_', ' ', $imageKey) }} (PNG)</label><br>
                @if ($images->has($imageKey))
                    <img src="{{ asset($images[$imageKey]->image_path) }}" alt="{{ $imageKey }}" class="mb-2" style="max-height:150px;"><br>
                @endif
                <input type="file" name="images[{{ $imageKey }}]" accept="image/png" class="form-control">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Save Changes</button>
        <a href="{{ route('admin.listing') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>

    <!-- need to be outside of form because nested form are not allowed -->
    <hr>
    <h4>Deletion of images</h4>

    @php
        $deletableImages = ['back_cover', 'full_book'];
    @endphp

    @foreach ($deletableImages as $imageKey)
        <div class="mb-3">
            @if ($images->has($imageKey))
                <label class="form-label text-capitalize">{{ str_replace('_', ' ', $imageKey) }}</label><br>
                <img src="{{ asset($images[$imageKey]->image_path) }}" alt="{{ $imageKey }}" class="mb-2" style="max-height:150px;"><br>
                <form method="POST"
                    action="{{ route('admin.product.image.delete', ['product' => $product->id, 'type' => $imageKey]) }}"
                    onsubmit="return confirm('Are you sure you want to delete this image?');"
                    class="mb-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">Delete Image</button>
                </form>
            @endif
        </div>
    @endforeach
</main>
@endsection
