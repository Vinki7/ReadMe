<?php

namespace App\Services\Auth;

use App\Repositories\UserRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Login;

class LoginService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function login(array $data): bool
    {
        $user = $this->userRepository->getByUsername($data['username']);

        if (!$user) {
            return false;
        }

        $validPassword = Hash::check($data['password'], $user->password);

        if (!$validPassword) {
            return false;
        }

        auth()->login($user);

        event(new Login('web', $user, false)); // <-- fire the login event manually

        $this->userRepository->updateLoginTimestamp($user);

        return true;
    }

}
