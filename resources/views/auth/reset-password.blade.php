@extends('layouts.auth')
@section('title', 'Reset Password')

@push('styles')
    @vite(['resources/css/_auth.scss'])
@endpush

@section('content')
<main class="container-fluid flex-grow-1 flex-column px-5">
    <section class="auth-panel col-12 col-lg-4 my-5">
        <header class="d-flex justify-content-center text-left flex-column">
            <h2>Reset Password</h2>
            <hr>
        </header>
        <form method="POST" action="{{ route('password.update') }}" class="d-flex flex-column gap-5 p-2 p-lg-5">
            @csrf

            <!-- Token -->
            <input type="hidden" name="token" value="{{ $token }}">

            <!-- Necessary input -->
            <!-- Email -->
            <section class="d-flex flex-column gap-2">
                <label for="email" class="label form-label">Email</label>
                <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" placeholder="Your email" required>
                @error('email')
                    @if (isset($message))
                        <small class="text-danger">{{ $message }}</small>
                    @endif
                @enderror
            </section>

            <!-- Password -->
            <section class="d-flex flex-column gap-2">
                <label for="password" class="label form-label">New password</label>
                <input type="password" name="password" id="password" class="input" placeholder="New password" required>

                @error('password')
                    @if (isset($message))
                        <small class="text-danger">{{ $message }}</small>
                    @endif
                @enderror
            </section>

            <!-- Confirm password -->
            <section class="d-flex flex-column gap-2">
                <label for="password_confirmation" class="label form-label">Confirm password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input" placeholder="Confirm password" required>

                @error('password_confirmation')
                    @if (isset($message))
                        <small class="text-danger">{{ $message }}</small>
                    @endif
                @enderror
            </section>

            <!-- Submit button -->
            <button class="btn btn-primary mt-2">Reset Password</button>

            <!-- Display error -->
            @foreach ($errors->all() as $error)
                <p class="text-danger">{{ $error }}</p>
            @endforeach
        </form>
    </section>
</main>
@endsection
