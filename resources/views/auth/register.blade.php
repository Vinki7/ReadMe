@extends('layouts.guest')

@push('styles')
    @vite(['resources/css/_auth.scss'])
@endpush

@section('title', 'Register - ReadMe')

@section('content')
<main class="container-fluid flex-grow-1 flex-column px-5">
    <section class="auth-panel col-12 col-lg-4 my-5">
        <header class="d-flex justify-content-center text-left flex-column">
            <h2>Register</h2>
            <hr>
        </header>
        <form action="{{ route('register') }}" method="POST" class="d-flex flex-column gap-5 p-2 p-lg-5">
            @csrf

            <!-- Name -->
            <section class="d-flex flex-column gap-2">
                <label for="name" class="label form-label">Name</label>
                <input type="text" name="name" id="name" class="input" value="{{ old('name') }}" required>
                @error('name') <small class="text-danger">{{ $message }}</small> @enderror
            </section>

            <!-- Surname -->
            <section class="d-flex flex-column gap-2">
                <label for="surname" class="label form-label">Surname</label>
                <input type="text" name="surname" id="surname" class="input" value="{{ old('surname') }}" required>
                @error('surname') <small class="text-danger">{{ $message }}</small> @enderror
            </section>

            <!-- Username -->
            <section class="d-flex flex-column gap-2">
                <label for="username" class="label form-label">Username</label>
                <input type="text" name="username" id="username" class="input" value="{{ old('username') }}" required>
                @error('username') <small class="text-danger">{{ $message }}</small> @enderror
            </section>

            <!-- Email -->
            <section class="d-flex flex-column gap-2">
                <label for="email" class="label form-label">Email</label>
                <input type="email" name="email" id="email" class="input" value="{{ old('email') }}" required>
                @error('email') <small class="text-danger">{{ $message }}</small> @enderror
            </section>

            <!-- Password -->
            <section class="d-flex flex-column gap-2">
                <label for="password" class="label form-label">Password</label>
                <input type="password" name="password" id="password" class="input" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </section>

            <!-- Confirm Password -->
            <section class="d-flex flex-column gap-2">
                <label for="password_confirmation" class="label form-label">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="input" required>
            </section>

            <section class="d-flex justify-content-center flex-column flex-sm-row flex-wrap gap-2 gap-lg-5">
                <a class="btn btn-charcoal" href="{{ route('login') }}">
                    {{ __('Sign-in instead') }}
                </a>

                <button type="submit" class="btn btn-secondary">
                    {{ __('Register') }}
                </button>
            </section>
        </form>
    </section>
</main>
@endsection
