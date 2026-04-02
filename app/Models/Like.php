<?php

namespace App\Models;

use App\Enums\LikeType;
use Illuminate\Database\Eloquent\Relations\Pivot;


#[Fillable(['user_id', 'post_id', 'type'])]
class Like extends Pivot
{
    

	/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
	public function casts(): array
	{
		return [
			'type'	=> LikeType::class,
		];
	}
}
