<?php

declare(strict_types=1);

namespace App\Modules\Users\Providers;

use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Infrastructure\Repositories\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;

/**
 * Service Provider del módulo de usuarios.
 *
 * Se encarga de registrar las dependencias del módulo
 * en el contenedor de servicios de Laravel y cargar
 * las rutas correspondientes.
 */
final class UsersServiceProvider extends ServiceProvider
{
    /**
     * Registra los servicios del módulo.
     *
     * Aquí se realiza la inyección de dependencias,
     * indicando qué implementación debe utilizar Laravel
     * cuando se solicite una interfaz.
     */
    public function register(): void
    {
        // Vincula el contrato del repositorio con
        // su implementación basada en Eloquent.
        $this->app->bind(
            UserRepositoryInterface::class,
            UserEloquentRepository::class
        );
    }

    /**
     * Inicializa el módulo.
     *
     * Aquí se cargan las rutas, eventos, vistas
     * u otros recursos necesarios durante el arranque
     * de la aplicación.
     */
    public function boot(): void
    {
        // Carga automáticamente las rutas del módulo.
        $this->loadRoutesFrom(
            __DIR__ . '/../Presentation/Routes/users.php'
        );
    }
}
