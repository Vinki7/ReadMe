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
                <p class="product-description">Publisher: Ikar, 2015</p>
                <p class="product-description">Language: SK</p>
                <p class="product-description">ISBN: 978-80-551-4307-1</p>
            </div>
            <form class="d-flex flex-column flex-sm-row flex-md-column gap-3 col-12 col-md-3 justify-content-center align-items-center">
                <h5>999&nbsp;999€</h5>
                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center align-items-center">
                    <label class="label" for="count">Amount:</label>
                    <input class="input w-25 align-self-center text-center" type="number" id="count" name="count" value="1" min="1">
                </div>
                <input type="submit" class="btn btn-secondary" value="Add to Cart">
            </form>
        </section>

        <section class="d-flex flex-column">
            <h3>Description</h3>
            <hr class="divider">
            <p>
                When a letter arrives for unhappy but ordinary Harry Potter, a decade-old secret is
                revealed to him that apparently he's the last to know. His parents were wizards,
                killed by a Dark Lord's curse when Harry was just a baby, and which he somehow survived.
                Leaving his unsympathetic aunt and uncle for Hogwarts, a wizarding school brimming with
                ghosts and enchantments, Harry stumbles upon a sinister mystery when he finds a three-headed
                dog guarding a room on the third floor. Then he hears of a missing stone with astonishing
                powers which could be valuable, dangerous - or both.
            </p>
        </section>
    </main>
@endsection
