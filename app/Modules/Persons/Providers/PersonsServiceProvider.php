<?php

declare(strict_types=1);

namespace App\Modules\Persons\Providers;

use Illuminate\Support\ServiceProvider;
use App\Modules\Persons\Domain\Contracts\PersonRepositoryInterface;
use App\Modules\Persons\Infrastructure\Repositories\PersonEloquentRepository;

final class PersonsServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            PersonRepositoryInterface::class,
            PersonEloquentRepository::class
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Presentation/Routes/persons.php');
    }
}
