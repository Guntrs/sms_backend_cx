<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use App\Modules\Persons\Presentation\Controllers\PersonController;

Route::middleware(['auth:sanctum'])
    ->prefix('api/v1')
    ->group(function () {
        Route::apiResource('persons', PersonController::class)
            ->parameters(['persons' => 'person']);
    });
