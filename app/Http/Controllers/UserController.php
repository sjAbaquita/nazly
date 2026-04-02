<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Attributes\Controllers\Authorize;
use Illuminate\Routing\Attributes\Controllers\Middleware;

#[Middleware('auth:sanctum', except: ['index'])]
class UserController extends Controller
{

	public function __construct(
		protected UserService $service
	){}

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // user registration in AuthController
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    #[Authorize('viewAny', User::class)]
    public function show(string $id): UserResource
    {
        return new UserResource(User::findOrFail($id));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    #[Authorize('update', 'user')]
    public function update(UpdateUserRequest $request, User $user): UserResource
    {
		$validatedData = $request->validated();

        return new UserResource($this->service->update($validatedData, $user));
    }

    /**
     * Remove the specified resource from storage.
     */
    #[Authorize('delete', 'user')]
    public function destroy(User $user): JsonResponse
    {
        return response()->json([
			'success' => $this->service->delete($user)
		]);
    }
}
