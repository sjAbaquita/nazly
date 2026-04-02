<?php

namespace App\Http\Controllers;

use App\Http\Requests\AuthenticateUserRequest;
use App\Http\Requests\RegisterUserRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Middleware;
use Illuminate\Support\Facades\Auth;

#[Middleware('auth:sanctum', except: ['register'])]
class AuthController extends Controller
{

	public function __construct(
		protected AuthService $service
	){}

	public function register(RegisterUserRequest $request): JsonResponse
	{
		$validatedData = $request->validated();

		return response()->json(
			$this->service->register($validatedData)
		);
	}

    public function authenticate(AuthenticateUserRequest $request): JsonResponse
	{
		$validatedData = $request->validated();

		// return new UserResource($this->service->authenticate($validatedData));
		return response()->json(
            $this->service->authenticate($validatedData)
        );
	}

	public function logout(Request $request): JsonResponse
	{
		return response()->json([
			'success' => $this->service->logout($request)
		]);
	}
}
