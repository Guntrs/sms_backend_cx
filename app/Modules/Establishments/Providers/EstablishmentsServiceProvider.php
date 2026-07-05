<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Providers;

use App\Modules\Establishments\Domain\Contracts\EstablishmentRepositoryInterface;
use App\Modules\Establishments\Infrastructure\Repositories\EstablishmentEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class EstablishmentsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            EstablishmentRepositoryInterface::class,
            EstablishmentEloquentRepository::class
        );
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(__DIR__ . '/../Infrastructure/Database/Migrations');
        $this->loadRoutesFrom(__DIR__ . '/../Presentation/Routes/establishments.php');
    }
}
