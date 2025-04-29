@extends('layouts.app')

@section('title', 'Address Information')

@push('styles')
    @vite(['resources/css/_cart.scss'])
@endpush

@section('content')
<main class="container-fluid flex-grow-1 row justify-content-center align-items-center g-0 py-4 px-5">
    <div class="modal-dialog modal-dialog-centered">
        <form class="modal-content" id="paymentForm" method="POST" action="{{ route('checkout.address') }}">
            @csrf
            <header class="modal-header">
                <h1 class="modal-title" id="addressModalLabel">Enter Address Information</h1>
            </header>
            <div class="modal-body d-flex flex-column gap-3">
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
            </div>
            <footer class="modal-footer">
                <button type="submit" class="btn btn-primary">Proceed to Payment</button>
            </footer>
        </form>
    </div>
</main>
@endsection
