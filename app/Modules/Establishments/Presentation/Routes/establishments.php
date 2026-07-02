<?php

// Importa el controlador de establecimientos.
use App\Modules\Establishments\Presentation\Controllers\EstablishmentController;

// Importa la fachada Route de Laravel.
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Rutas del módulo Establishments
|--------------------------------------------------------------------------
| Define las rutas REST protegidas para la gestión de establecimientos.
*/
Route::middleware(['auth:sanctum']) // Protege las rutas mediante autenticación con Sanctum.
    ->prefix('api/v1')                 // Agrega el prefijo /v1 a todas las rutas.
    ->group(function () {

        // Genera automáticamente las rutas REST (index, store, show, update y destroy)
        // utilizando el EstablishmentController.
        Route::apiResource('establishments', EstablishmentController::class)

            // Define el nombre del parámetro utilizado en las rutas.
            ->parameters([
                'establishments' => 'establishment',
            ]);
    });
