<?php

use App\Modules\Users\Domain\Exceptions\UserNotFoundException;
use App\Modules\Users\Domain\Exceptions\UserAlreadyExistsException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {

        // Usuario no encontrado → 404
        $exceptions->renderable(function (UserNotFoundException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 404);
        });

        // Usuario ya existe → 409
        $exceptions->renderable(function (UserAlreadyExistsException $e) {
            return response()->json([
                'message' => $e->getMessage(),
            ], 409);
        });

    })->create();
