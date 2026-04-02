<?php

namespace App\Services;

use App\Models\User;

class UserService
{
	public function update($data, User $user): User
	{
		$user->update($data);

		return $user->fresh();
	}

	public function delete(User $user): bool
	{
		return $user->delete();
	}
}