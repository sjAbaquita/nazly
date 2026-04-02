<?php

namespace App\Services;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class AuthService {

	public function register($data): array
	{
		$user = User::create([
            'email' 		=> $data['email'],
			'name'			=> $data['firstname'] .' '. $data['lastname'],
			'firstname'		=> $data['firstname'],
			'lastname'		=> $data['lastname'],
            'password' 		=> Hash::make($data['password'])
        ]);

        event(new Registered($user));

        return [
			'success' 	=> true,
			'user' 		=> new UserResource($user),
			// 'token' 	=> $user->createToken('API_'.config('app.name').'_'.$user->id)->plainTextToken
		];
	}

	public function authenticate($data): array
	{
		if(Auth::attempt($data)) {
			$user = Auth::user();

			// if($user->approved) {
				return [
					'success' 	=> true,
					'user' 		=> new UserResource($user),
					'token' 	=> $user->createToken('API_'.config('app.name').'_'.$user->id)->plainTextToken
				];
			// } else {
			// 	return [
			// 		'success'	=> false,
			// 		'message'	=> 'User not approved. Please contact administrator for approval of your account'
			// 	];
			// }
		} else {
			return [
				'success' => false,
				'message' => 'Invalid email or password'
			];
		}
	}

	

	public function logout(Request $request): bool
	{
		$user = Auth::user();

		Log::info('User logged in', ['id' => $user]);
		$user->tokens()->delete(); //delete all associated tokens
		// $request->user()->currentAccessToken()->delete(); //delete current token

        return true;
	}
}