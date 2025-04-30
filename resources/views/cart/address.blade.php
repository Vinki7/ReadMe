@extends('layouts.app')

@section('title', 'Address Information')

@push('styles')
    @vite(['resources/css/_cart.scss'])
@endpush

@section('content')
<main class="container-fluid flex-grow-1 row justify-content-center align-items-center g-0 py-4 px-5">
    <section class="card col-12 col-lg-9 p-4 shadow-sm">
        <form class="col-12 d-flex flex-column justify-content-center" id="paymentForm" method="POST" action="{{ route('checkout.address') }}">
            @csrf
            <header class="ps-sm-1 ps-md-3">
                <h1 class="h2 text-secondary">Enter Address Details</h1>
            </header>

            <hr>

            <div class="d-flex align-self-center flex-column gap-3 col-12 col-sm-9 col-md-6">
                <section class="d-flex flex-column gap-2">
                    <label class="label">Full Name</label>
                    <input class="input" type="text" name="fullName" id="fullName" placeholder="Enter name" required>
                </section>
                <section class="d-flex flex-column gap-2">
                    <label class="label">E-mail</label>
                    <input class="input" type="text" name="eMial" id="eMial" placeholder="Enter E-mail" required>
                </section>
                <section class="d-flex flex-column gap-2">
                    <label class="label">Street Address</label>
                    <input class="input" type="text" name="streetAddress" id="streetAddress" placeholder="Enter address" required>
                </section>
                <section class="d-flex flex-column gap-2">
                    <label class="label">City</label>
                    <input class="input" type="text" name="city" id="city" placeholder="Enter city" required>
                </section>
                <section class="d-flex flex-column gap-2">
                    <label class="label">Postal Code</label>
                    <input class="input" type="text" name="postalCode" id="postalCode" placeholder="Enter postal code" required>
                </section>
                <section class="d-flex flex-column gap-2">
                    <label class="label">Country</label>
                    <input class="input" type="text" name="country" id="country" placeholder="Enter country" required>
                </section>
                <section class="d-flex flex-column gap-2">
                    <h4 class="title">Choose delivery method:</h4>
                    <div class="d-flex justify-content-center flex-columnt flex-sm-row gap-5">
                        @foreach ($deliveryMethods as $method)
                            <span class="d-flex justify-content-center gap-4">
                                <label class="label" for="{{$method}}">{{ $method }}</label>
                                <input type="radio" name="deliveryMethod" id="{{$method}}" value="{{$method}}"  required>
                            </span>
                        @endforeach
                    </div>
                        {{-- <input class="input" type="text" name="deliveryMethod" id="deliveryMethod" placeholder="Enter CVV" required> --}}
                </section>
            </div>
            <hr>
            <footer class="modal-footer">
                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </footer>
        </form>
    </section>
</main>
@endsection
