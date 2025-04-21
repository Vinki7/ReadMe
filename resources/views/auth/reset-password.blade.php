@extends('layouts.auth')

@push('styles')
    @vite(['resources/css/_auth.scss'])
@endpush

@section('title', 'Sign-in - ReadMe')
@section('content')
<main class="container-fluid flex-grow-1 flex-column px-5">
    @auth(Auth::user())
    <section class="auth-panel col-12 col-lg-4 my-5">
        <header class="d-flex justify-content-center text-left flex-column">
            <h2>Welcome back, {{ Auth::user()->name }}</h2>
            <hr>
        </header>
        <p class="text-center">You are already logged in. Please log out to access another account.</p>
        <section class="d-flex justify-content-center">
            <a class="btn btn-secondary" href="{{ route('logout') }}">
                {{ __('Logout') }}
            </a>
        </section>
    </section>
    @endauth

    @guest(Auth::check())
    <section class="auth-panel col-12 col-lg-4 my-5">
        <header class="d-flex justify-content-center text-left flex-column">
            <h2>Sign-in</h2>
            <hr>
        </header>
        <form action="{{ route('password.email') }}" method="POST" class="d-flex flex-column gap-5 p-2 p-lg-5">
            @csrf
            <!-- Username -->
            <section class="d-flex flex-column gap-2">
                <label for="username" class="label form-label">Username</label>
                <input type="text" name="username" id="username" class="input" value="{{ old('username') }}" required>
                @error('username')
                    @if (isset($message))
                        <small class="text-danger">{{ $message }}</small>
                    @endif
                @enderror
            </section>

            <!-- Password -->
            <section class="d-flex flex-column gap-2">
                <label for="email" class="label form-label">Email</label>
                <input type="email" name="email" id="email" class="input" required>

                @error('email')
                    @if (isset($message))
                        <small class="text-danger">{{ $message }}</small>
                    @endif
                @enderror
            </section>

            <section class="d-flex justify-content-center flex-column flex-sm-row flex-wrap gap-2 gap-lg-5">
                <button type="submit" class="btn btn-secondary">
                    {{ __('Reset password') }}
                </button>
            </section>
        </form>
    </section>
    @endguest
</main>
@endsection
