<?php

use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Foundation\Http\Middleware\HandlePrecognitiveRequests;
use Illuminate\Http\Request;
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        //
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Unauthenticated (401)
		$exceptions->render(function (AuthenticationException $e, Request $request) {
			if ($request->is('api/*')) {
				return response()->json([
					'message' => 'Unauthenticated.',
					'status' => 401,
				], 401);
			}
		});

		// Forbidden (403)
		$exceptions->render(function (HttpException $e, Request $request) {
			if ($request->is('api/*') && $e->getStatusCode() === 403) {
				return response()->json([
					'message' => 'Forbidden.',
					'status' => 403,
				], 403);
			}
		});
    })->create();
