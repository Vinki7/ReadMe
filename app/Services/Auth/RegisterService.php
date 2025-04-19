<?php

namespace App\Services\Auth;

use App\Enums\Role;
use App\Models\User;
use App\Repositories\UserRepository;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class RegisterService
{
    protected UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data): User
    {
        $validator = $this->validate($data);

        $validatedData = $validator->validated();

        $newUser = $this->createUser($validatedData);

        event(new Registered($newUser));

        return $newUser;
    }

    private function validate(array $data)
    {
        $validator = Validator::make($data, [
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:users',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            'password_confirmation' => 'required_with:password|same:password|min:8',
        ]);

        if ($validator->fails()) {
            throw new ValidationException($validator);
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
