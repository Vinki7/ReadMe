@extends('layouts.app')
@section('title', 'Products - ReadMe')

@push('styles')
    @vite(['resources/css/_products.scss'])
@endpush

@section('content')
<main class="container-fluid row row-cols-auto mx-0 justify-content-center">

    <!-- Mobile filter button -->
    <div class="d-lg-none col-12 text-center my-3">
        <button class="btn btn-charcoal" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
            Filters
        </button>
    </div>

    <!-- Filter panel (large screen) -->
    <aside class="col-lg-3 d-none d-lg-block pt-4 ps-5">
        @include('products._filter-form', ['isOffcanvas' => false])
    </aside>

    <!-- Filter panel (small screen) -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title">Filters</h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body">
            @include('products._filter-form', ['isOffcanvas' => true])
        </div>
    </div>

    <!-- Main Content -->
    <section class="col-12 col-lg-9 pt-4">
		<!-- Sort menu -->
        <form method="GET" id="searchSortForm" class="btn-container row row-cols-1 row-cols-md-2 align-items-center justify-content-center gap-3 gap-lg-0 gap mb-4 px-md-5">
            <div class="col">
                <input type="text" name="search" class="form-control" placeholder="Search"
                    value="{{ request('search') }}">
            </div>
            <div class="col-7 col-sm-4 d-flex flex-wrap gap-2 justify-content-center">
                @foreach ([['name', 'Name'], ['price', 'Price']] as [$key, $label])
                    @foreach ([['asc', 'up'], ['desc', 'down']] as [$dir, $icon])
                        @php $value = "{$key}_{$dir}"; @endphp
                        <div>
                            <input type="radio" id="{{ $value }}" name="sort" value="{{ $value }}" class="d-none"
                                {{ request('sort') === $value ? 'checked' : '' }}
                                onchange="document.getElementById('searchSortForm').submit()">
                            <label for="{{ $value }}" class="btn btn-secondary {{ request('sort') === $value ? 'active-selection' : '' }}">
                                {{ $label }} <img src="{{ asset("images/icons/chevron_{$icon}_icon.png") }}" class="order-icon">
                            </label>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </form>

        <div class="row row-cols-auto justify-content-center gap-4 pb-3 g-0">
            @forelse ($products as $product)
                <x-product-listing-card
                    :id="$product->id"
                    :frontCoverPath="$product->frontCover"
                    :title="$product->title"
                    :authors="$product->authors"
                    :price="$product->price"
                    :productId="$product->id"
                />
            @empty
                <p class="text-center">No products found.</p>
            @endforelse
        </div>

        <div class="row justify-content-center gap-4 pb-3">
            @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                <a href="{{ $url }}" class="btn btn-secondary col-1 {{ $products->currentPage() === $page ? 'active' : '' }}">
                    {{ $page }}
                </a>
            @endforeach
        </div>
    </section>
</main>
@endsection
