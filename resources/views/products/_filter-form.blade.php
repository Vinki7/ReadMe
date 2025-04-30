<form method="GET" id="filterForm" class="filter-box">
    <h5 class="mb-3">Filter</h5>

    <div class="mb-3">
        <label class="form-label">Genre</label>
        <select name="genre" class="form-select">
            <option value="">All</option>
            @foreach ($genres as $genre)
                <option value="{{ $genre }}" {{ request('genre') == $genre ? 'selected' : '' }}>
                    {{ $genre }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">
        <label class="form-label">Author</label>
        <select name="author" class="form-select">
            <option value="">All</option>
            @foreach ($authors as $author)
                <option value="{{ $author }}" {{ request('author') == $author ? 'selected' : '' }}>
                    {{ $author }}
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

    <button type="submit" class="btn btn-primary w-100 mt-3">
        Apply Filters
    </button>
</form>
