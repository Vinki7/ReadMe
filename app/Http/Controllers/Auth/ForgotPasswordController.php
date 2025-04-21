<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\PasswordService;

class ForgotPasswordController extends Controller
{
    private PasswordService $passwordService;

    public function __construct(PasswordService $forgotPasswordService)
    {
        $this->passwordService = $forgotPasswordService;
    }

    public function show()
    {
        if (auth()->check()) {
            return redirect()->route('home.index');
        }

        return view('auth.forgot-password');
    }

    public function sendResetLink(Request $request)
    {
        $this->passwordService->sendResetLink($request->input('email'), $request->input('username'));

        return redirect()->route('password.reset');
        // Validate the request


        // $this->validate($request, [
        //     'email' => 'required|email|exists:users,email',
        // ]);

        // $this->forgotPasswordService->sendResetLink($request->input('email'));

        // return redirect()->back()->with('status', 'Password reset link sent to your email.');
    }
}
