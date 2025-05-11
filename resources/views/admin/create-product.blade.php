@extends('layouts.app')
@section('title', 'Add Product')

@section('content')
<main class="container py-5">
    <h1 class="mb-4">Add New Product</h1>

    <form method="POST" action="{{ route('admin.product.store') }}" enctype="multipart/form-data">
        @csrf

        <!-- Title -->
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" value="{{ old('title') }}" class="form-control" required>
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" required>{{ old('description') }}</textarea>
        </div>

        <!-- Price -->
        <div class="mb-3">
            <label class="form-label">Price (€)</label>
            <input type="number" step="0.01" name="price" value="{{ old('price') }}" class="form-control" required>
        </div>

        <!-- Category -->
        <div class="mb-3">
            <label class="form-label">Category</label>
            <select name="category" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->value }}" {{ old('category') == $category->value ? 'selected' : '' }}>
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
                    <option value="{{ $author->id }}" {{ collect(old('authors'))->contains($author->id) ? 'selected' : '' }}>
                        {{ $author->name }} {{ $author->surname }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Publisher -->
        <div class="mb-3">
            <label class="form-label">Publisher</label>
            <input name="publisher" value="{{ old('publisher') }}" class="form-control">
        </div>

        <!-- ISBN -->
        <div class="mb-3">
            <label class="form-label">ISBN</label>
            <input name="isbn" value="{{ old('isbn') }}" class="form-control">
        </div>

        <!-- Publication Date -->
        <div class="mb-3">
            <label class="form-label">Publication Date</label>
            <input type="date" name="publication_date" value="{{ old('publication_date') }}" class="form-control">
        </div>

        <!-- Language -->
        <div class="mb-3">
            <label class="form-label">Language</label>
            <input name="language" value="{{ old('language') }}" class="form-control">
        </div>

        <hr>
        <h4>Images</h4>

        @foreach (['front_cover', 'book_insights'] as $imageKey)
            <div class="mb-3">
                <label class="form-label text-capitalize">{{ str_replace('_', ' ', $imageKey) }} (PNG)</label>
                <input type="file" name="images[{{ $imageKey }}]" accept="image/png" class="form-control" required>
            </div>
        @endforeach

        @foreach (['full_book', 'back_cover'] as $imageKey)
            <div class="mb-3">
                <label class="form-label text-capitalize">{{ str_replace('_', ' ', $imageKey) }} (PNG)</label>
                <input type="file" name="images[{{ $imageKey }}]" accept="image/png" class="form-control">
            </div>
        @endforeach

        <button type="submit" class="btn btn-primary">Create Product</button>
        <a href="{{ route('admin.listing') }}" class="btn btn-outline-secondary">Cancel</a>
    </form>
</main>
@endsection
