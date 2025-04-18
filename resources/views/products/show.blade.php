@extends('layouts.app')
@section('title', 'Product Details - ReadMe')
@push('styles')
    @vite(['resources/css/_product-details.scss'])
@endpush

@section('content')
    <main class="container d-flex flex-grow-1 gap-4 flex-column px-5">
        <section class="d-flex row flex-column flex-sm-row flex-wrap gap-4 my-3">
            <div class="small-gallery d-flex flex-row gap-3 justify-content-center col-12 col-sm-5 col-md-3" data-bs-toggle="modal" data-bs-target="#showGalery">
                <div class="d-flex flex-column col-8">
                    <img class="product-image" src="{{ asset($product->frontCover->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - front cover" title="{{ $product->title }}">
                </div>

                <div class="d-flex col-2 flex-column gap-2 justify-content-center">
                    <div>
                        <img class="product-image" src="{{ asset($product->backCover->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - back cover" title="{{ $product->title }}">
                    </div>
                    <div>
                        <img class="product-image" src="{{ asset($product->bookInsights->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - insights" title="{{ $product->title }}">
                    </div>
                    <div>
                        <img class="product-image" src="{{ asset($product->fullBook->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - full book" title="{{ $product->title }}">
                    </div>

                </div>
            </div>

            <div class="d-flex flex-column col-12 col-sm-5 flex-grow-1  justify-content-center">
                <h1 class="product-detail-title">{{ $product->title }}</h1>
                <h2 class="subtitle">{{ implode(', ', $product->authors) }}</h2>
                <p class="product-description">Publisher: {{ $product->publisher }}, {{ $product->publicationDate }}</p>
                <p class="product-description">Language: {{ $product->language }}</p>
                <p class="product-description">ISBN: {{ $product->isbn }}</p>
            </div>
            <form class="d-flex flex-column flex-sm-row flex-md-column gap-3 col-12 col-md-3 justify-content-center align-items-center">
                <h5>{{ $product->price }} €</h5>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center align-items-center">
                    <label class="label" for="count">Amount:</label>
                    <input class="input w-100 align-self-center text-center" type="number" id="count" name="count" value="1" min="1" max="{{ $product->stock }}" required>
                </div>
                <input type="submit" class="btn btn-secondary" value="Add to Cart">
            </form>
        </section>

        <section class="d-flex flex-column">
            <h3>Description</h3>
            <hr class="divider">
            <p>
                {{ $product->description }}
            </p>
        </section>
    </main>
@endsection
@section('modals')
    <section class="modal fade" id="showGalery" tabindex="-1" aria-labelledby="showGaleryModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered justify-content-center">
            <div class="modal-content">
                <div id="carouselIndicators" class="carousel slide">
                    <div class="carousel-indicators">
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Front cover"></button>
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="1" aria-label="Back cover"></button>
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="2" aria-label="Book insights"></button>
                    <button type="button" data-bs-target="#carouselIndicators" data-bs-slide-to="3" aria-label="Full book"></button>
                    </div>
                    <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="product-image" src="{{ asset($product->frontCover->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - front cover" title="{{ $product->title }}">
                    </div>
                    <div class="carousel-item">
                        <img class="product-image" src="{{ asset($product->backCover->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - back cover" title="{{ $product->title }}">
                    </div>
                    <div class="carousel-item">
                        <img class="product-image" src="{{ asset($product->bookInsights->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - insights" title="{{ $product->title }}">
                    </div>
                    <div class="carousel-item">
                        <img class="product-image" src="{{ asset($product->fullBook->getImagePath()) }}" class="d-block w-100" alt="{{ $product->title }} - full book" title="{{ $product->title }}">
                    </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselIndicators" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselIndicators" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </section>
@endsection
