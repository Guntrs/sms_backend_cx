<?php

declare(strict_types=1);

namespace App\Modules\Auth\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Auth\Domain\Contracts\AuthRepositoryInterface;
use App\Modules\Auth\Infrastructure\Repositories\AuthEloquentRepository;

// Registra el módulo Auth en Laravel: binding de interfaz y rutas
class AuthServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Binding: cuando alguien pida AuthRepositoryInterface, Laravel inyecta AuthEloquentRepository
        $this->app->bind(
            AuthRepositoryInterface::class,
            AuthEloquentRepository::class,
        );
    }

    public function boot(): void
    {
        // Carga las rutas del módulo Auth
        $this->loadRoutesFrom(__DIR__.'/../Presentation/Routes/auth.php');
    }
}
