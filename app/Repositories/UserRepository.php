<?php

namespace App\Repositories;

use App\Repositories\Interfaces\IRepository;
use App\Models\User;

class UserRepository implements IRepository
{
	public function create(array $data): User
	{
		$user = User::create($data);

        return $user;
	}

	public function delete($id)
	{
		// Implement the delete method
	}

	public function getAll()
	{
		// Implement the getAll method
	}

	public function getById($id)
	{
		// Implement the getById method
	}

	public function update($id, array $data)
	{

	}

    public function getByEmail(string $email): ?User
    {
        return User::where('email', $email)->first();
    }

    public function getByUsername(string $username): ?User
    {
        return User::where('username', $username)->first();
    }

    public function updateLoginTimestamp(User $user): bool
    {
        return $user->update(['last_login' => now()]);
    }
}
