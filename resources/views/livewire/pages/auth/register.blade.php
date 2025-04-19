<?php

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $name = '';
    public string $email = '';
    public string $password = '';
    public string $password_confirmation = '';

    /**
     * Handle an incoming registration request.
     */
    public function register(): void
    {
        $validated = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'string', 'confirmed', Rules\Password::defaults()],
        ]);

        $validated['password'] = Hash::make($validated['password']);

        event(new Registered($user = User::create($validated)));

        Auth::login($user);

        $this->redirect(route('dashboard', absolute: false), navigate: true);
    }
}; ?>

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
            <form wire:submit="register" class="d-flex flex-column gap-5 p-2 p-lg-5">
                <!-- Email Address -->
                <section class="d-flex flex-column gap-2">
                    <x-input-label for="email" :value="__('Email')" class="label form-label" />
                    <x-text-input wire:model="email" id="email" class="input" type="email" name="email" required autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </section>

                <!-- Username -->
                <section class="d-flex flex-column gap-2">
                    <x-input-label for="username" :value="__('Userame')" class="label form-label" />
                    <x-text-input wire:model="username" id="username" class="input" type="text" name="name" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('username')" class="mt-2" />
                </section>

                <!-- Password -->
                <div class="d-flex flex-column gap-2">
                    <x-input-label for="password" :value="__('Password')" class="label form-label" />

                    <x-text-input wire:model="password" id="password" class="input"
                                    type="password"
                                    name="password"
                                    required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="d-flex flex-column gap-2">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="label form-label" />

                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="input"
                                    type="password"
                                    name="password_confirmation" required autocomplete="new-password" />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}" wire:navigate>
                        {{ __('Already registered?') }}
                    </a>

                    <x-primary-button class="ms-4">
                        {{ __('Register') }}
                    </x-primary-button>
                </div>
            </form>
        </section>
    </main>
@endsection
