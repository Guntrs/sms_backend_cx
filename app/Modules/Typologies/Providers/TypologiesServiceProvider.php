<?php

declare(strict_types=1);

namespace App\Modules\Typologies\Providers;

use Illuminate\Support\ServiceProvider;

class TypologiesServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Los bindings Interface → Implementación se agregan aquí en fases posteriores
    }

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../Infrastructure/Database/Migrations'
        );
    }
}
