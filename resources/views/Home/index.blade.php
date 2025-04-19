@extends('layouts.app')
@section('title', 'Home - ReadMe')
@push('styles')
    @vite(['resources/css/_index.scss'])
@endpush

@section('content')
<main class="container-fluid flex-grow-1 flex-column px-5">
    <section class="container-fluid title-section" role="img" aria-labelledby="hero-heading">
            <div class="text-white d-flex flex-column justify-content-center align-items-start">
            <h1>ReadMe</h1>
            <h3 class="ms-lg-5">The place where stories live...</h3>
        </div>
    </section>
    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <header class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Fantasy</a>
        </header>
        <div class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            @foreach ($fantasyBooks as $book)
                <x-product-listing-card
                    :frontCoverPath="$book->frontCover"
                    :title="$book->title"
                    :authors="$book->authors"
                    :price="$book->price"
                    :productId="$book->id"
                />
            @endforeach
        </div>
    </section>

    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <span class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Educative</a>
        </span>
        <section class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            @foreach ($educationBooks as $book)
                <x-product-listing-card
                    :frontCoverPath="$book->frontCover"
                    :title="$book->title"
                    :authors="$book->authors"
                    :price="$book->price"
                    :productId="$book->id"
                />
            @endforeach
        </section>
    </section>
</main>
<main class="container-fluid flex-grow-1 flex-column px-5">
    <section class="container-fluid title-section" role="img" aria-labelledby="hero-heading">
            <div class="text-white d-flex flex-column justify-content-center align-items-start">
            <h1>ReadMe</h1>
            <h3 class="ms-lg-5">The place where stories live...</h3>
        </div>
    </section>
    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <header class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Fantasy</a>
        </header>
        <div class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            @foreach ($fantasyBooks as $book)
                <x-product-listing-card
                    :frontCoverPath="$book->frontCover"
                    :title="$book->title"
                    :authors="$book->authors"
                    :price="$book->price"
                    detailsUrl="../product-details/product-details.html"
                />
            @endforeach
        </div>
    </section>

    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <span class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Educative</a>
        </span>
        <section class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            @foreach ($educationBooks as $book)
                <x-product-listing-card
                    :frontCoverPath="$book->frontCover"
                    :title="$book->title"
                    :authors="$book->authors"
                    :price="$book->price"
                    detailsUrl="../product-details/product-details.html"
                />
            @endforeach
        </section>
    </section>
</main>
@endsection
