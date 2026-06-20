<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserEstablishmentSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('sms_users_establishment')->insert([
            // user_id = 1 → administrador creado en UserSeeder
            'users_id'          => 1,
            // establishment_id = 1 → Casa Matriz creada en EstablishmentSeeder
            'establishment_id'  => 1,
            // role = 311 → Administrador en sms_typologies
            'role'              => 311,
            'status'            => 1,
            'created_by'        => 0,
            'creation_date'     => $now,
            'modified_by'       => 0,
            'modification_date' => $now,
        ]);
    }
}
