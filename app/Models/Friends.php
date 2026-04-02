<?php

namespace App\Models;

use App\Enums\FriendStatus;
use Illuminate\Database\Eloquent\Relations\Pivot;

#[Table('friendships')]
#[Fillable(['user_id', 'friend_id', 'status'])]
class Friends extends Pivot
{
	
	/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
	public function casts(): array
	{
		return [
			'status'	=> FriendStatus::class,
		];
	}
}
