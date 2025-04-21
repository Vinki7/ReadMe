<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Auth\PasswordService;
use Illuminate\Support\Facades\Password;

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
        $result = $this->passwordService->sendResetLink($request->input('email'), $request->input('username'));

        if ($result === Password::RESET_LINK_SENT) {
            return redirect()->back()->with('status', __($result));
        }

        return redirect()->back()->withErrors(['email' => __($result)]);
    }
}
