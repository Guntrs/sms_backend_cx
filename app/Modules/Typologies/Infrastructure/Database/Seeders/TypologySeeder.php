<?php

declare(strict_types=1);

namespace App\Modules\Typologies\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TypologySeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        $typologies = [
            // Raíz Global
            ['typology_id' => 100, 'parent_typology_id' => null, 'description' => 'Global'],

            // Fuentes de Contacto
            ['typology_id' => 200, 'parent_typology_id' => 100, 'description' => 'Fuentes de Contacto'],
            ['typology_id' => 201, 'parent_typology_id' => 200, 'description' => 'Redes Sociales'],
            ['typology_id' => 202, 'parent_typology_id' => 200, 'description' => 'Referido'],
            ['typology_id' => 203, 'parent_typology_id' => 200, 'description' => 'Correo'],
            ['typology_id' => 204, 'parent_typology_id' => 200, 'description' => 'Telefono'],
            ['typology_id' => 205, 'parent_typology_id' => 200, 'description' => 'Formulario'],

            // Estados de Contacto
            ['typology_id' => 210, 'parent_typology_id' => 100, 'description' => 'Estados de Contacto'],
            ['typology_id' => 211, 'parent_typology_id' => 210, 'description' => 'Nuevo Contacto'],
            ['typology_id' => 212, 'parent_typology_id' => 210, 'description' => 'Contactado'],
            ['typology_id' => 213, 'parent_typology_id' => 210, 'description' => 'Contacto Inactivo'],
            ['typology_id' => 214, 'parent_typology_id' => 210, 'description' => 'Vigente'],

            // Monedas
            ['typology_id' => 250, 'parent_typology_id' => 100, 'description' => 'Monedas'],
            ['typology_id' => 251, 'parent_typology_id' => 250, 'description' => 'USD',     'value1' => 'USD', 'value2' => '$'],
            ['typology_id' => 252, 'parent_typology_id' => 250, 'description' => 'GTQ',     'value1' => 'GTQ', 'value2' => 'Q'],

            // Género
            ['typology_id' => 290, 'parent_typology_id' => 100, 'description' => 'Genero'],
            ['typology_id' => 291, 'parent_typology_id' => 290, 'description' => 'Masculino', 'value1' => 'M'],
            ['typology_id' => 292, 'parent_typology_id' => 290, 'description' => 'Femenino',  'value1' => 'F'],

            // Tipo de Sangre
            ['typology_id' => 300, 'parent_typology_id' => 100, 'description' => 'Tipo de Sangre'],
            ['typology_id' => 301, 'parent_typology_id' => 300, 'description' => 'O+',  'value1' => 'O+'],
            ['typology_id' => 302, 'parent_typology_id' => 300, 'description' => 'O-',  'value1' => 'O-'],
            ['typology_id' => 303, 'parent_typology_id' => 300, 'description' => 'A+',  'value1' => 'A+'],
            ['typology_id' => 304, 'parent_typology_id' => 300, 'description' => 'B+',  'value1' => 'B+'],

            // Roles del Sistema
            ['typology_id' => 310, 'parent_typology_id' => 100, 'description' => 'Roles'],
            ['typology_id' => 311, 'parent_typology_id' => 310, 'description' => 'Administrador', 'value1' => '311'],
            ['typology_id' => 312, 'parent_typology_id' => 310, 'description' => 'Operador',      'value1' => '312'],
            ['typology_id' => 313, 'parent_typology_id' => 310, 'description' => 'Usuario',       'value1' => '313'],

            // Tipo de Estado
            ['typology_id' => 500, 'parent_typology_id' => 100, 'description' => 'Tipo de Estado'],
            ['typology_id' => 501, 'parent_typology_id' => 500, 'description' => 'Activo',    'value1' => '1'],
            ['typology_id' => 502, 'parent_typology_id' => 500, 'description' => 'Inactivo',  'value1' => '0'],
            ['typology_id' => 503, 'parent_typology_id' => 500, 'description' => 'Suspendido','value1' => '2'],

            // Tipo de Cliente
            ['typology_id' => 530, 'parent_typology_id' => 100, 'description' => 'Tipo de Cliente'],
            ['typology_id' => 531, 'parent_typology_id' => 530, 'description' => 'Persona Natural'],
            ['typology_id' => 532, 'parent_typology_id' => 530, 'description' => 'Persona Juridica'],
            ['typology_id' => 533, 'parent_typology_id' => 530, 'description' => 'Entidad Gubernamental'],
            ['typology_id' => 534, 'parent_typology_id' => 530, 'description' => 'ONG/ Asociación'],

            // Segmento Comercial
            ['typology_id' => 540, 'parent_typology_id' => 100, 'description' => 'Segmento Comercial'],
            ['typology_id' => 541, 'parent_typology_id' => 540, 'description' => 'Mayorista'],
            ['typology_id' => 542, 'parent_typology_id' => 540, 'description' => 'Distribuidor'],
            ['typology_id' => 543, 'parent_typology_id' => 540, 'description' => 'Minorista'],
            ['typology_id' => 544, 'parent_typology_id' => 540, 'description' => 'Extranjero'],

            // Términos de Pago
            ['typology_id' => 550, 'parent_typology_id' => 100, 'description' => 'Términos de Pago'],
            ['typology_id' => 551, 'parent_typology_id' => 550, 'description' => 'Contado',  'value1' => '0'],
            ['typology_id' => 552, 'parent_typology_id' => 550, 'description' => '30 dias',  'value1' => '30'],
            ['typology_id' => 553, 'parent_typology_id' => 550, 'description' => '60 dias',  'value1' => '60'],

            // Providers Type
            ['typology_id' => 560, 'parent_typology_id' => 100, 'description' => 'Tipo de Proveedor'],
            ['typology_id' => 561, 'parent_typology_id' => 560, 'description' => 'Productos de Consumo'],
            ['typology_id' => 562, 'parent_typology_id' => 560, 'description' => 'Papelería y Librería'],
            ['typology_id' => 563, 'parent_typology_id' => 560, 'description' => 'Tecnología y Equipos'],
            ['typology_id' => 564, 'parent_typology_id' => 560, 'description' => 'Servicios Profesionales'],
        ];

        foreach ($typologies as $typology) {
            DB::table('sms_typologies')->insert([
                'typology_id'        => $typology['typology_id'],
                'parent_typology_id' => $typology['parent_typology_id'] ?? null,
                'description'        => $typology['description'],
                'value1'             => $typology['value1'] ?? null,
                'value2'             => $typology['value2'] ?? null,
                'value3'             => null,
                'status'             => 1,
                'created_by'         => 0,
                'creation_date'      => $now,
                'modified_by'        => 0,
                'modification_date'  => $now,
            ]);
        }
    }
}
