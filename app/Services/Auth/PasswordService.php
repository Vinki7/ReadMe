<?php

namespace App\Services\Auth;

use App\Services\Helpers\ValidationService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Client\Request;

class PasswordService
{
    private ValidationService $validationService;
    public function __construct(ValidationService $validationService)
    {
        $this->validationService = $validationService;
    }
    /**
     * Send a password reset link to the user's email.
     *
     * @param string $email
     * @param string $username
     * @return void
     */
    public function sendResetLink($email, $username): string
    {

        $this->validationService->emailExists($email);
        $this->validationService->usernameExists($username);

        $this->validationService->throwIfInvalid();

        $result = Password::sendResetLink(['email' => $email]);

        return $result;
    }

    public function resetPassword(array $request): string
    {
        $this->validateToken($request['token'] ?? '');

        $this->validationService->emailExists($request['email'] ?? null);

        $this->validatePassword($request['password'] ?? '', $request['password_confirmation'] ?? '');

        $this->validationService->throwIfInvalid();

        $status = $this->sendResetRequest($request);

        return $status;
    }

    private function validateToken(string $token): void
    {
        $this->validationService->validateField(
            'token',
            $token ?? null,
            ['required', 'string']
        );

        return;
    }

    private function validatePassword(string $password, string $password_confirmation): void
    {
        $this->validationService->validateField(
            'password',
            [
                'password' => $password,
                'password_confirmation' => $password_confirmation,
            ],
            [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        return;
    }

    private function sendResetRequest(array $request): string
    {
        $status = Password::reset(
            [
                'email' => $request['email'],
                'password' => $request['password'],
                'password_confirmation' => $request['password_confirmation'],
                'token' => $request['token'],
            ],
            function ($user, $password) {
                $user->password = Hash::make($password);
                $user->save();
            }
        );

        return $status;
    }
}
