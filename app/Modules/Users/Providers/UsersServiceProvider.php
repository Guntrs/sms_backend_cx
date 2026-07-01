<?php

declare(strict_types=1);

namespace App\Modules\Users\Providers;

use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Infrastructure\Repositories\UserEloquentRepository;
use Illuminate\Support\ServiceProvider;

final class UsersServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(
            UserRepositoryInterface::class,
            UserEloquentRepository::class,
        );
    }

    public function boot(): void
    {
        $this->loadRoutesFrom(__DIR__ . '/../Presentation/Routes/users.php');
    }
}
