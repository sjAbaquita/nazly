<?php

namespace App\Models;

use App\Enums\PostPrivacy;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


#[Fillable(['user_id', 'content', 'thumbnail', 'privacy'])]
#[Hidden(['updated_at', 'deleted_at'])]
class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory, SoftDeletes;

	/**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
	public function casts(): array
	{
		return [
			'privacy' => PostPrivacy::class,
		];
	}

	public function user()
    {
        return $this->belongsTo(User::class);
    }

	public function likes()
	{
		return $this->belongsToMany(User::class, 'likes')
			->withPivot('type')
			->withTimestamps();
	}
}
