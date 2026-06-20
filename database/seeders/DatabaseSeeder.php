<?php

declare(strict_types=1);

namespace Database\Seeders;

use Illuminate\Database\Seeder;

// Seeders de cada módulo en orden de dependencias
use App\Modules\Typologies\Infrastructure\Database\Seeders\TypologySeeder;
use App\Modules\Users\Infrastructure\Database\Seeders\PersonSeeder;
use App\Modules\Establishments\Infrastructure\Database\Seeders\EstablishmentSeeder;
use App\Modules\Users\Infrastructure\Database\Seeders\UserSeeder;
use App\Modules\Establishments\Infrastructure\Database\Seeders\UserEstablishmentSeeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            TypologySeeder::class,          // 1. Catálogos base — todo depende de esto
            PersonSeeder::class,            // 2. Datos personales del admin
            EstablishmentSeeder::class,     // 3. Sucursal principal
            UserSeeder::class,              // 4. Usuario administrador
            UserEstablishmentSeeder::class, // 5. Asignar admin a sucursal con rol 311
        ]);
    }
}
