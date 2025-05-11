<?php

namespace App\Http\Controllers\Auth;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Services\Auth\RegisterService;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected RegisterService $registerService;

    public function __construct(RegisterService $registerService)
    {
        $this->registerService = $registerService;
    }

    public function show()
    {
        return view('auth.register');
    }

    public function store(Request $request)
    {
        if (auth()->check()) {
            return redirect()->route('home.index');
        }

        $user = $this->registerService->register($request->all());

        auth()->login($user);

        if ($user->hasRole(Role::Admin)) {
            return redirect()->route('home.index')->with('success', 'Registration successful! Please check your email for verification.');
        }

        if ($user->hasRole(Role::User)) {
            return redirect()->route('home.index')->with('success', 'Registration successful! Please check your email for verification.');
        }

        return redirect()->route('home.index')->with('success', 'Registration successful! Please check your email for verification.');
    }
}
