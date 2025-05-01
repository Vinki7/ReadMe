<form method="GET" id="filterForm" class="filter-box">
    <h5 class="mb-3">Filter</h5>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category" class="form-select">
            <option value="">All</option>
            @foreach ($categories as $category)
                <option value="{{ $category }}" {{ request('category') == $category ? 'selected' : '' }}>
                    {{ $category }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Author</label>
        <select name="author" class="form-select">
            <option value="">All</option>
            @foreach ($authors as $author)
                @php
                    $fullName = $author->name . ' ' . $author->surname;
                @endphp
                <option value="{{ $fullName }}" {{ request('author') === $fullName ? 'selected' : '' }}>
                    {{ $fullName }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Language</label>
        <select name="language" class="form-select">
            <option value="">All</option>
            @foreach ($languages as $language)
                <option value="{{ $language }}" {{ request('language') == $language ? 'selected' : '' }}>
                    {{ $language }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Price Range</label>
        <div class="d-flex gap-2">
            <input type="number" class="form-control" name="min_price" placeholder="Min" value="{{ request('min_price') }}">
            <input type="number" class="form-control" name="max_price" placeholder="Max" value="{{ request('max_price') }}">
        </div>
    </div>

    <div class="d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary">
            Apply
        </button>

        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            Reset Filters
        </a>
    </div>
</form>
