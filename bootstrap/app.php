<?php

use App\Http\Middleware\AdminMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            "admin"=> AdminMiddleware::class,
        ]);
        $middleware->validateCsrfTokens(except:[
           'sslcommerz/success',
           'sslcommerz/failure',
           'sslcommerz/cancel',
           'sslcommerz/ipn',
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
       $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, Request $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'success' => false,
                    'message' => 'Unauthorized. Please provide a valid access token.',
                ], Response::HTTP_UNAUTHORIZED);
            }

        });
    })->create();
