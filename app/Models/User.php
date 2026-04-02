<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enums\PostPrivacy;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

#[Fillable(['name', 'firstname', 'lastname', 'email', 'default_privacy', 'password'])]
#[Hidden(['password', 'remember_token', 'created_at', 'updated_at', 'email_verified_at', 'deleted_at', 'default_privacy'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
			'default_privacy' => PostPrivacy::class,
        ];
    }

	
    
	public function friends() {
    	return $this->belongsToMany(User::class, 'friendships', 'user_id', 'friend_id')
			->withPivot('status')
			->wherePivot('status', 'accepted');
	}

	public function posts()
	{
		return $this->hasMany(Post::class);
	}

	public function likedPosts()
	{
		return $this->belongsToMany(Post::class, 'likes')
			->withTimestamps();
	}
}
