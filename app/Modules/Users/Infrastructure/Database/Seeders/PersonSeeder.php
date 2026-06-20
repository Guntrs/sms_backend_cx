<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonSeeder extends Seeder
{
    public function run(): void
    {
        $now = now();

        DB::table('sms_persons')->insert([
            'person_key'            => 'PER-0001',
            'first_name'            => 'Administrador',
            'second_name'           => null,
            'first_surname'         => 'Sistema',
            'second_surname'        => null,
            'birthdate'             => null,
            'gender'                => null,
            'blood_type'            => null,
            'profession'            => null,
            'dpi'                   => null,
            'nit'                   => 'CF',
            'email'                 => 'admin@sms.com',
            'phone_number'          => null,
            'secondary_phone_numer' => null,
            'address'               => null,
            'status'                => 1,
            'created_by'            => 0,
            'creation_date'         => $now,
            'modified_by'           => 0,
            'modification_date'     => $now,
        ]);
    }
}
