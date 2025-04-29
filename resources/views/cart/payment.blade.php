@extends('layouts.app')

@section('title', 'Payment Information')

@push('styles')
    @vite(['resources/css/_cart.scss'])
@endpush

@section('content')
<main class="container-fluid flex-grow-1 row justify-content-center align-items-start g-0 py-4 px-5">
    <div class="card col-12 col-lg-9 p-4 shadow-sm">
        <header class="ps-sm-1 ps-md-3">
            <h1 class="h2 text-secondary">Enter Address Details</h1>
        </header>
        <hr>
        {{-- Delivery information --}}
        <section>
            <h1 class="h4 ps-0 ps-sm-3">Order summary</h1>
            <hr class="col-11 mx-auto">
            @foreach ($products as $product)
            <article class="cart-item row flex-row align-items-center py-3 px-3 px-sm-5">
                <div class="col-12 col-sm-8 d-flex align-items-center flex-wrap flex-sm-nowrap">
                    <img class="order-image" src="{{ asset($product->frontCover) }}" alt="image of bought book" title="Image of bought book">
                    <div class="card-body">
                        <a class="title card-title" href="{{ route('products.show', $product->id) }}">
                            {{ $product->title }}
                        </a>
                    </div>
                </div>
                <div class="d-flex col-12 col-sm-4 flex-row align-items-center justify-content-center justify-content-md-end gap-3 mt-2 mt-md-0 flex-wrap">

                    <span class="ms-3 fw-bold">Quantity: {{$cart[$product->id]['quantity'] ?? 1}} Total:&nbsp;{{ $product->price * ($cart[$product->id]['quantity'] ?? 1) }}&nbsp;€</span>
                </div>
            </article>
            @endforeach
            <div class="d-flex flex-column flex-md-row justify-content-center align-items-center mt-4">
                <h4 class="fw-bold">Total: {{ $finalPrice }} €</h4>
            </div>
        </section>
        <hr>
        {{-- Payment information --}}
        <section class="tab-content" id="paymentTabsContent">
            <h1 class="h4 ps-0 ps-sm-3">Enter Payment Information</h1>
            <p class="description ps-0 ps-sm-4">Please select a payment method and fill in the required information.</p>
            <hr class="col-11 mx-auto">
            <section class="card-nav col-12 nav nav-pills d-flex justify-content-center gap-3 gap-md-5" id="myTab" role="tablist">
                <div class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#card" type="button" role="tab" aria-controls="card" aria-selected="true">Card</button>
                </div>
                <div class="nav-item" role="presentation">
                    <button class="nav-link" id="on-delivery-tab" data-bs-toggle="tab" data-bs-target="#on-delivery" type="button" role="tab" aria-controls="on-delivery" aria-selected="false">On-delivery</button>
                </div>
            </section>
            <hr class="col-11 mx-auto">

            {{-- Card Form --}}
            <form class="tab-pane active" method="POST" action="{{ route('checkout.payment') }}" id="card" role="tabpanel" aria-labelledby="card-tab" tabindex="0">
                @csrf

                <div class="d-flex col-12 px-1 px-sm-5 gap-4 flex-column">
                    <input type="hidden" name="payment_method" id="paymentMethod" value="card">
                    <section class="d-flex flex-column gap-2">
                        <label class="label" for="cardName">Cardholder Name</label>
                        <input class="input" type="text" name="cardName" id="cardName" placeholder="Enter name" required>
                    </section>
                    <section class="d-flex flex-column gap-2">
                        <label class="label" for="cardNumber">Card Number</label>
                        <input class="input" type="text" name="cardNumber" id="cardNumber" placeholder="Enter card number" required>
                    </section>
                    <section class="d-flex flex-column gap-2">
                        <label class="label" for="expiryDate">Expiry Date</label>
                        <input class="input" type="text" name="expiryDate" id="expiryDate" placeholder="Enter expiration date" required>
                    </section>
                    <section class="d-flex flex-column gap-2">
                        <label class="label" for="cvv">CVV</label>
                        <input class="input" type="text" name="cvv" id="cvv" placeholder="Enter CVV" required>
                    </section>
                    <section class="d-flex flex-column gap-2">
                        <p class="text-center">
                            By submitting payment details, I confirm that the information is correct and authorize this transaction.
                        </p>
                        <div class="d-flex flex-column gap-3 flex-md-row flex-wrap justify-content-center">
                            <button type="submit" class="btn btn-secondary">Submit Payment</button>
                        </div>
                    </section>
                </div>
            </form>

            {{-- On-delivery Form --}}
            <form class="tab-pane" id="on-delivery" role="tabpanel" aria-labelledby="on-delivery-tab" tabindex="0">
                @csrf
                <div class="d-flex col-12 px-1 px-sm-5 gap-4 flex-column ">
                    <input type="hidden" name="payment_method" id="paymentMethod" value="card">
                    <section class="d-flex flex-column gap-2 mt-3 p-5 text-center">
                        <p>By submitting this payment method, I agree to pay the total amount of <strong>{{ $finalPrice }}&nbsp;€</strong> for my order on delivery.</p>
                        <div class="d-flex flex-column gap-3 flex-md-row flex-wrap justify-content-center">
                            <button type="submit" class="btn btn-secondary">Submit order</button>
                        </div>
                    </section>
                </div>
            </form>
        </section>
    </div>
</main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
