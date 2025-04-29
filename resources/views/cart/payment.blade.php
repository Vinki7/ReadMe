@extends('layouts.app')

@section('title', 'Payment Information')

@push('styles')
    @vite(['resources/css/_cart.scss'])
@endpush

@section('content')
<main class="container-fluid flex-grow-1 row justify-content-center align-items-start g-0 py-4 px-5">
    <div class="card text-center">
        @csrf
        <header class="card-header">
            <h1 class="h1 text-secondary">Finish payment</h1>
        </header>
        {{-- Delivery information --}}
        <section>

        </section>

        {{-- Payment information --}}
        <section class="card-body tab-content" id="paymentTabsContent">
            <article class="d-flex justify-content-center align-items-center flex-column gap-3">
                <h1 class="h3">Enter Payment Information</h1>
                <p class="card-text">Please select a payment method and fill in the required information.</p>
            </article>

            <hr class="divider col-11 mx-auto">
            <section class="card-nav col-12 nav nav-pills d-flex justify-content-center gap-3 gap-md-5" id="myTab" role="tablist">
                <div class="nav-item" role="presentation">
                    <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#card" type="button" role="tab" aria-controls="card" aria-selected="true">Card</button>
                </div>
                <div class="nav-item" role="presentation">
                    <button class="nav-link" id="on-delivery-tab" data-bs-toggle="tab" data-bs-target="#on-delivery" type="button" role="tab" aria-controls="on-delivery" aria-selected="false">On-delivery</button>
                </div>
            </section>
            <hr class="divider col-11 mx-auto">

            {{-- Card Form --}}
            <form class="tab-pane active" method="POST" action="{{ route('checkout.payment') }}" id="card" role="tabpanel" aria-labelledby="card-tab" tabindex="0">
                <div class="d-flex col-12 px-1 px-sm-5 gap-4 flex-column ">
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
            <div class="tab-pane" id="on-delivery" role="tabpanel" aria-labelledby="on-delivery-tab" tabindex="0">
                <input type="hidden" name="payment_method" id="paymentMethod" value="card">
                <section class="d-flex flex-column gap-2 mt-3 p-5">
                    <p>By submitting this payment method, I agree to pay the total amount of <strong>{{ $finalPrice }} €</strong> for my order on delivery.</p>
                    <div class="d-flex flex-column gap-3 flex-md-row flex-wrap justify-content-center">
                        <button type="submit" class="btn btn-secondary">Submit order</button>
                    </div>
                </section>
            </div>
        </section>
    </div>
</main>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@endpush
