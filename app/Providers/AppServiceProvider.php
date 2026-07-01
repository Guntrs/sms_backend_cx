<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

// Módulos del sistema SMS
use App\Modules\Auth\Providers\AuthServiceProvider;
use App\Modules\Typologies\Providers\TypologiesServiceProvider;
use App\Modules\Users\Providers\UsersServiceProvider;
use App\Modules\Establishments\Providers\EstablishmentsServiceProvider;
use App\Modules\Customers\Providers\CustomersServiceProvider;
use App\Modules\Providers\Providers\ProvidersServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Registro de módulos — cada módulo se registra aquí
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(TypologiesServiceProvider::class);
        $this->app->register(UsersServiceProvider::class);
        $this->app->register(EstablishmentsServiceProvider::class);
        $this->app->register(CustomersServiceProvider::class);
        $this->app->register(ProvidersServiceProvider::class);

        $this->app->register(\App\Modules\Users\Providers\UsersServiceProvider::class);


    }

    public function boot(): void {}
}
