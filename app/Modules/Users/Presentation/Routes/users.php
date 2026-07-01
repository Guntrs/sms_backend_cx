<?php

use App\Modules\Users\Presentation\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/**
 * Rutas del módulo de usuarios.
 *
 * Define los endpoints REST para la gestión de usuarios,
 * protegidos mediante autenticación con Laravel Sanctum.
 */
Route::middleware(['auth:sanctum'])

    // Prefijo común para el versionado de la API.
    ->prefix('api/v1')

    // Agrupa las rutas con la misma configuración.
    ->group(function () {

        /**
         * Genera automáticamente las rutas REST del recurso users.
         *
         * Endpoints generados:
         * GET    /v1/users          -> index()
         * POST   /v1/users          -> store()
         * GET    /v1/users/{user}   -> show()
         * PUT    /v1/users/{user}   -> update()
         * PATCH  /v1/users/{user}   -> update()
         * DELETE /v1/users/{user}   -> destroy()
         */
        Route::apiResource('users', UserController::class)

            // Cambia el nombre del parámetro de la ruta
            // de {users} a {user}.
            ->parameters([
                'users' => 'user',
            ]);
    });
