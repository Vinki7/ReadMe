<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Services\Auth\PasswordService;
use App\Services\Helpers\ValidationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ResetPasswordController extends Controller
{
    private PasswordService $passwordService;
    private ValidationService $validationService;

    public function __construct()
    {
        $this->validationService = new ValidationService();
        $this->passwordService = new PasswordService($this->validationService);
    }

    public function show(string $token = null)
    {
        if (auth()->check()) {
            return redirect()->route('home.index');
        }

        return view('auth.reset-password', ['token' => $token]);
    }

    public function update(Request $request)
    {
        $result = $this->passwordService->resetPassword($request->all());

        if ($result === Password::PASSWORD_RESET) {
            return redirect()->route('home.index')->with('status', __($result));
        }

        return redirect()->back()->withErrors(['email' => __($result)]);
    }
}
