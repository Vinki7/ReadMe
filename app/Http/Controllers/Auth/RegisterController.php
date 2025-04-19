<?php

namespace App\Http\Controllers\Auth;

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
        $user = $this->registerService->register($request->all());

        auth()->login($user);

        return redirect()->route('home')->with('success', 'Registration successful! Please check your email for verification.');
    }
}
