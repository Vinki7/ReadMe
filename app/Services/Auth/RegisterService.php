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
        $validator = new ValidationService();

        $validator->validateField(
            'name',
            $data['name'],
            ['required', 'string', 'max:255']
        );

        $validator->validateField(
            'surname',
            $data['surname'],
            ['required', 'string', 'max:255']
        );

        $validator->validateField(
            'username',
            $data['username'],
            ['required', 'string', 'max:255', 'unique:users,username']
        );

        $validator->validateField(
            'email',
            $data['email'],
            ['required', 'string', 'email', 'max:255', 'unique:users,email']
        );

        $validator->validateField(
            'password',
            $data['password'],
            ['required', 'string', 'min:8', 'confirmed']
        );

        $validator->validateField(
            'password_confirmation',
            $data['password_confirmation'],
            ['required', 'string', 'min:8']
        );

        $result = $validator->combineResults();

        if (!$result) {
            throw ValidationException::withMessages($validator->getMessages()->toArray());
        }

        return $validator;
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
