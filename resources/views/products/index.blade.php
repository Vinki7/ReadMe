@extends('layouts.app')
@section('title', 'Products - ReadMe')
@push('styles')
    @vite(['resources/css/_products.scss'])
@endpush

@push('scripts')
	@vite(['resources/js/products.js'])
@endpush

@section('content')
<main class="container-fluid row row-cols-auto mx-0 justify-content-center">
	<!-- Side filter panel -->
	<aside class="col-lg-3 d-none d-lg-block pt-5 ps-5">
		<div class="filter-box">
			<h5>Filter</h5>
			<div class="price-card">
				<label>
					Price Range
				</label>
				<div class="price-content">
					<div>
						<label>Min</label>
						<p id="min-value">€0</p>
					</div>
					<div>
						<label>Max</label>
						<p id="max-value">€9999</p>
					</div>
				</div>

				<div class="range-slider">
					<div class="range-fill"></div>

					<input
						type="range"
						class="min-price"
						value="0"
						min="0"
						max="9990"
						step="10"
					/>

					<input
						type="range"
						class="max-price"
						value="9990"
						min="0"
						max="9990"
						step="10"
					/>
				</div>
			</div>



			<label class="form-label mt-3">Genre</label>
			<select class="form-select">
				<option class="option-value">All</option>
				<option class="option-value">Option data1</option>
				<option class="option-value">Option data2</option>
				<option class="option-value">Option data3</option>
			</select>

			<label class="form-label mt-3">Author</label>
			<select class="form-select">
				<option class="option-value">All</option>
				<option class="option-value">Option data1</option>
				<option class="option-value">Option data2</option>
				<option class="option-value">Option data3</option>
			</select>

			<label class="form-label mt-3">Language</label>
			<select class="form-select">
				<option class="option-value">All</option>
				<option class="option-value">Option data1</option>
				<option class="option-value">Option data2</option>
				<option class="option-value">Option data3</option>
			</select>
		</div>
	</aside>

	<!-- Small screen filter button -->
	<div class="d-lg-none col-8 col-sm-3 text-center">
		<button class="filter-button btn btn-charcoal d-lg-none col-12 my-3" data-bs-toggle="offcanvas" data-bs-target="#filterOffcanvas">
			Filter
		</button>
	</div>

	<!-- Small screenfilter panel -->
	<div class="offcanvas offcanvas-start" tabindex="-1" id="filterOffcanvas">
		<div class="offcanvas-header">
			<h5 class="offcanvas-title">Filter</h5>
			<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
		</div>
		<div class="offcanvas-body">
			<div class="filter-box">
				<label>Price Range</label>
				<div class="price-content">
					<div>
						<label>Min</label>
						<p id="min-value">€0</p>
					</div>
					<div>
						<label>Max</label>
						<p id="max-value">€9999</p>
					</div>
				</div>

				<div class="range-slider">
					<div class="range-fill"></div>
					<input
						type="range"
						class="min-price"
						value="0"
						min="0"
						max="9990"
						step="10"
					/>

					<input
						type="range"
						class="max-price"
						value="9990"
						min="0"
						max="9990"
						step="10"
					/>
				</div>
			</div>

			<label class="form-label mt-3">Genre</label>
			<select class="form-select">
				<option class="option-value">All</option>
				<option class="option-value">Option data1</option>
				<option class="option-value">Option data2</option>
				<option class="option-value">Option data3</option>
			</select>

			<label class="form-label mt-3">Author</label>
			<select class="form-select">
				<option class="option-value">All</option>
				<option class="option-value">Option data1</option>
				<option class="option-value">Option data2</option>
				<option class="option-value">Option data3</option>
			</select>

			<label class="form-label mt-3">Language</label>
			<select class="form-select">
				<option class="option-value">All</option>
				<option class="option-value">Option data1</option>
				<option class="option-value">Option data2</option>
				<option class="option-value">Option data3</option>
			</select>
		</div>
	</div>


	<!-- Main area-->
	<section class="col-12 col-lg-9 pt-5">
		<!-- Search/order area -->
		<div class="btn-container row row-cols-1 row-cols-md-2 align-items-center justify-content-center gap-3 gap-lg-0 gap mb-4 px-md-5">
			<!-- Search bar -->
			<form method="GET" class="col">
				<input
					type="text"
					name="search"
					class="form-control col-12"
					placeholder="Search"
					value="{{ request('search') }}"
				>
			</form>

			<!-- Ordering buttons -->
			<form method="GET" class="col-7 col-sm-4 d-flex flex-column justify-content-end flex-md-row flex-wrap gap-2" role="group" id="sortForm">
				<!-- Name sort -->
				<div class="d-flex flex-column flex-xl-row gap-2">
					<div>
						<input type="radio" id="name-asc" name="sort" value="name_asc" class="order-radio" {{ request('sort') === 'name_asc' ? 'checked' : '' }} onchange="document.getElementById('sortForm').submit()">
						<label for="name-asc" class="order-button btn btn-secondary {{ request('sort') === 'name_asc' ? 'active-selection' : '' }}">
							Name <img src="{{ asset('images/icons/chevron_up_icon.png') }}" alt="up arrow" class="order-icon">
						</label>
					</div>
					<div>
						<input type="radio" id="name-desc" name="sort" value="name_desc" class="order-radio" {{ request('sort') === 'name_desc' ? 'checked' : '' }} onchange="document.getElementById('sortForm').submit()">
						<label for="name-desc" class="order-button btn btn-secondary {{ request('sort') === 'name_desc' ? 'active-selection' : '' }}">
							Name <img src="{{ asset('images/icons/chevron_down_icon.png') }}" alt="down arrow" class="order-icon">
						</label>
					</div>
				</div>
			
				<!-- Price sort -->
				<div class="d-flex flex-column flex-xl-row gap-2">
					<div>
						<input type="radio" id="price-asc" name="sort" value="price_asc" class="order-radio" {{ request('sort') === 'price_asc' ? 'checked' : '' }} onchange="document.getElementById('sortForm').submit()">
						<label for="price-asc" class="order-button btn btn-secondary {{ request('sort') === 'price_asc' ? 'active-selection' : '' }}">
							Price <img src="{{ asset('images/icons/chevron_up_icon.png') }}" alt="up arrow" class="order-icon">
						</label>
					</div>
					<div>
						<input type="radio" id="price-desc" name="sort" value="price_desc" class="order-radio" {{ request('sort') === 'price_desc' ? 'checked' : '' }} onchange="document.getElementById('sortForm').submit()">
						<label for="price-desc" class="order-button btn btn-secondary {{ request('sort') === 'price_desc' ? 'active-selection' : '' }}">
							Price <img src="{{ asset('images/icons/chevron_down_icon.png') }}" alt="down arrow" class="order-icon">
						</label>
					</div>
				</div>
			</form>
		</div>

		<!-- Product Cards -->
		<div class="row row-cols-auto justify-content-center gap-4 pb-3 g-0">
			@forelse ($products as $product)
				<x-product-listing-card
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
		<div class="row btn-container justify-content-center gap-4 pb-3">
			@foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
				@php
					$params = [
						'search' => request('search'),
						'sort' => request('sort'),
						'page' => $page,
					];
				@endphp
				<a href="{{ route('products.index', $params) }}" class="btn btn-secondary col-1 {{ $products->currentPage() === $page ? 'active-selection' : '' }}">
					{{ $page }}
				</a>
			@endforeach
		</div>

	</section>
</main>
@endsection
