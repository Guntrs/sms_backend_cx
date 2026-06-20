<?php

declare(strict_types=1);

namespace App\Modules\Customers\Providers;

use Illuminate\Support\ServiceProvider;

class CustomersServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        $this->loadMigrationsFrom(
            __DIR__ . '/../Infrastructure/Database/Migrations'
        );
    }
}
