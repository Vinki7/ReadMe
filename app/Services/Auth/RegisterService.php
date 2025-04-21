<?php

namespace App\Services\Auth;

use App\Enums\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use App\Services\Helpers\ValidationService;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterService
{
    protected UserRepository $userRepository;
    protected ValidationService $validationService;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
        $this->validationService = new ValidationService();
    }

    public function register(array $data): User
    {
        $validator = $this->validate($data);

        $validatedData = $validator->getResults();

        $newUser = $this->createUser($validatedData);

        event(new Registered($newUser));

        return $newUser;
    }

    private function validate(array $data)
    {

        $this->validationService->validateField(
            'name',
            $data['name'],
            ['required', 'string', 'max:255']
        );

        $this->validationService->validateField(
            'surname',
            $data['surname'],
            ['required', 'string', 'max:255']
        );

        $this->validationService->validateField(
            'username',
            $data['username'],
            ['required', 'string', 'max:255', 'unique:users,username']
        );

        $this->validationService->validateField(
            'email',
            $data['email'],
            ['required', 'string', 'email', 'max:255', 'unique:users,email']
        );

        $this->validationService->validateField(
            'password',
            [
                'password' => $data['password'] ?? null,
                'password_confirmation' => $data['password_confirmation'] ?? null,
            ],
            [
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]
        );

        $this->validationService->throwIfInvalid();

        return $this->validationService;
    }

    private function createUser(array $data): User
    {
        $user = $this->userRepository->create([
            'name' => $data['name'],
            'surname' => $data['surname'],
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $user->assignRole(Role::User);

        return $user;
    }
}
