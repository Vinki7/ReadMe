<form method="GET" id="filterForm" class="filter-box">
    <h5 class="mb-3">Filter</h5>

    <div class="mb-3">
        <label class="form-label">Category</label>
        <select name="category" class="form-select">
            <option value="">All</option>
            @php
                use App\Enums\Category;
            @endphp
            @foreach (Category::cases() as $category)
                <option value="{{ $category->value }}" {{ request('category') === $category->value ? 'selected' : '' }}>
                    {{ ucfirst(str_replace('_', ' ', $category->name)) }}
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
            <input type="number" class="form-control" name="min_price" placeholder="Min" step="0.01" min="{{ floor($minPrice) }}" max="{{ ceil($maxPrice) }}" value="{{ request('min_price') }}">
            <input type="number" class="form-control" name="max_price" placeholder="Max" step="0.01" min="{{ floor($minPrice) }}" max="{{ ceil($maxPrice) }}" value="{{ request('max_price') }}">
        </div>
    </div>

    <div class="d-flex justify-content-between mt-3">
        <button type="submit" class="btn btn-primary">
            Apply
        </button>

        <button type="button" class="btn btn-outline-secondary" onclick="resetFilters()">
            Reset Filters
        </button>

        <script>
            function resetFilters() {
                const form = document.getElementById('searchSortForm');
                form.querySelectorAll('input[name="search"]').forEach(input => input.value = '');
                form.querySelectorAll('input[name="sort"]').forEach(input => input.checked = false);
                form.submit();
            }
        </script>
    </div>
</form>
