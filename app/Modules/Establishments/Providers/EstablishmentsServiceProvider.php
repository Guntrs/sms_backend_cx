<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Providers;

use Illuminate\Support\ServiceProvider;

class EstablishmentsServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../Infrastructure/Database/Migrations'
        );
    }
}
