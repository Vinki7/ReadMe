@extends('layouts.app')

@section('title', 'Your Cart')

@push('styles')
    @vite(['resources/css/_cart.scss'])
@endpush

@section('content')
    <main class="container-fluid flex-grow-1 row justify-content-center align-items-center g-0 py-4 px-5">
        <section class="card container p-5 shadow-sm">
            <h1>Your Shopping Cart</h1>
            <hr>

            <div class="cart-items">
                @if(!empty($items))
                    @foreach($products as $product)
                        <article class="cart-item row flex-row align-items-center p-3 border-bottom">
                            <div class="col-12 col-md-5 d-flex align-items-center flex-wrap flex-md-nowrap">
                                <img class="order-image" src="{{ $product->frontCover }}" alt="image of bought book" title="Image of bought book">
                                <div class="card-body">
                                    <a class="title card-title" href="{{ route('products.show', $product->id) }}">
                                        {{ $product->title }}
                                    </a>
                                    <p class="mb-0">{{ implode(', ', $product->authors) }}</p>
                                </div>
                            </div>
                            <div class="d-flex col-12 col-md-7 flex-row align-items-center justify-content-center justify-content-md-end gap-3 mt-2 mt-md-0 flex-wrap">
                                <form method="POST" action="{{ route('cart.update', $product->id) }}" class="d-flex align-items-center justify-content-center justify-content-md-end gap-3 flex-wrap">
                                    <span class="ms-3 fw-bold">{{ $product->price }} €</span>
                                    @csrf
                                    @method('PATCH')
                                    <input class="input col-12 col-sm-4" type="number" name="quantity" value="{{ $items[$product->id]['quantity'] ?? 1 }}" min="1">
                                    <button type="submit" class="btn btn-sm btn-primary">Update</button>
                                </form>
                                <form method="POST" action="{{ route('cart.destroy', $product->id) }}" class="d-flex align-items-center justify-content-center w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-icon">
                                        <img src="{{ asset('images/icons/remove.png') }}" alt="Remove item" title="Remove item">
                                    </button>
                                </form>

                            </div>
                        </article>
                    @endforeach
                @else
                    <p>Your cart is empty.</p>
                @endif
        </div>
        </section>
    </main>
    @endsection
