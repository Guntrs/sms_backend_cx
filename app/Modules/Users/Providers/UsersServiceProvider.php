<?php

declare(strict_types=1);

namespace App\Modules\Users\Providers;

use Illuminate\Support\ServiceProvider;

class UsersServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../Infrastructure/Database/Migrations'
        );
    }
}
