<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\LoginService;

class LoginController extends Controller
{
    private LoginService $loginService;

    public function __construct(LoginService $loginService)
    {
        $this->loginService = $loginService;
    }

    public function show()
    {
        if(auth()->check()) {
            return redirect()->route('home.index');
        }

        return view('auth.login');
    }

    public function store(Request $request)
    {
        $user = $this->loginService->login($request->all());

        if($user) {
            return redirect()->route('home.index')->with('success', 'Successfully logged in!');
        }

        return redirect()->back()->withErrors([
            'login' => 'Invalid credentials, please try again.'
        ]);
    }

    public function logout(Request $request)
    {
        auth()->logout();

        return redirect()->route('home.index')->with('success', 'Logout successful!');
    }
}
