<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    // return $request->user()->toJson();
	return response()->json($request->user());
});


Route::middleware('auth:sanctum')->group(function () {
	
});

// User Authentication
Route::post('authenticate', [AuthController::class, 'authenticate']);
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout']);

//User Update profile
Route::put('/users/{user}', [UserController::class, 'update']);
Route::delete('/users/{user}', [UserController::class, 'destroy']);

// Users
Route::group(['prefix' => 'users'], function() {

});