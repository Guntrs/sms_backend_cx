<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstablishmentSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('sms_establishment')->insert([
            'establishment_key'         => 'EST-0001',
            'parent_establishment_id'   => null,
            'establishment_name'        => 'Casa Matriz',
            'establishment_nit'         => 'CF',
            'establishment_description' => 'Sucursal principal del sistema',
            'establishment_address'     => 'Guatemala, Guatemala',
            'establishment_email'       => 'admin@sms.com',
            'establishment_phone'       => null,
            // Referencia a typology_id 141 = Librería (puedes cambiarlo según el negocio)
            'establishment_type'        => '141',
            'status'                    => 1,
            'created_by'                => 0,
            'creation_date'             => $now,
            'modified_by'               => 0,
            'modification_date'         => $now,
        ]);
    }
}
