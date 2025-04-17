@extends('layouts.app')
@section('title', 'Home - ReadMe')
@push('styles')
    <link rel="stylesheet" href="{{ asset('css/index.css') }}">
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
                <article class="card col-12 col-md-5 col-lg-3 flex-column">
                    <div class="d-flex flex-column flex-sm-row">
                        <div class="col-12 col-sm-5">
                            <img src="{{ asset($book->frontCover) }}" class="card-img img-fluid" alt="{{ $book->title }}" title="{{ $book->title }}">
                        </div>
                        <div class="card-body flex-grow-1 flex-column">
                            <a class="title card-title" href="../product-details/product-details.html" href="../product-details/product-details.html">
                                {{ $book->title }}
                            </a>
                            <div class="card-text">
                                <p>Author:<br>{{ implode(', ', $book->authors) }}</p>
                                <p><strong>{{ $book->price }} €</strong></p>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                        <button class="btn btn-secondary">Add to Cart</button>
                    </footer>
                </article>
            @endforeach
        </div>
    </section>

    <section class="container my-5 d-flex justify-content-center flex-column gap-3">
        <span class="category-header d-flex justify-content-start w-full">
            <a class="btn btn-charcoal" href="../products/products.html">Educative</a>
        </span>
        <section class="d-flex justify-content-start flex-column flex-md-row flex-wrap gap-5">
            @foreach ($educationBooks as $book)
                <article class="card col-12 col-md-5 col-lg-3 flex-column">
                    <div class="d-flex flex-column flex-sm-row">
                        <div class="col-12 col-sm-5">
                            <img src="{{ asset($book->frontCover) }}" class="card-img img-fluid" alt="{{ $book->title }}" title="{{ $book->title }}">
                        </div>
                        <div class="card-body flex-grow-1 flex-column">
                            <a class="title card-title" href="../product-details/product-details.html">{{ $book->title }}</a>
                            <div class="card-text">
                                <p>Author:<br>{{ implode(", ", $book->authors) }}</p>
                                <p><strong>{{ $book->price }} €</strong></p>
                            </div>
                        </div>
                    </div>
                    <footer class="card-footer mt-auto d-flex justify-content-center flex-row flex-wrap">
                        <button class="btn btn-secondary">Add to Cart</button>
                    </footer>
                </article>
            @endforeach
        </section>
    </section>
</main>
@endsection
