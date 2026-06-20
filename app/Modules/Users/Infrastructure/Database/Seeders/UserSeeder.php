<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('sms_users')->insert([
            'user_key'              => 'USR-0001',
            'parent_user_id'        => null,
            // Referencia al person_id = 1 creado en PersonSeeder
            'person_id'             => 1,
            'user_name'             => 'admin',
            // Contraseña hasheada — NUNCA texto plano
            'password'              => Hash::make('Admin2024*'),
            'password_change_date'  => null,
            'access_attempt'        => 0,
            'user_full_name'        => 'Administrador Sistema',
            'user_email'            => 'admin@sms.com',
            'user_phone'            => null,
            'professional_number'   => null,
            'signature'             => null,
            'image_url'             => null,
            'status'                => 1,
            'created_by'            => 0,
            'creation_date'         => $now,
            'modified_by'           => 0,
            'modification_date'     => $now,
        ]);
    }
}
