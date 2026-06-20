<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_persons', function (Blueprint $table) {
            // PK
            $table->bigIncrements('person_id');

            // Clave única de negocio
            $table->string('person_key', 50)->unique();

            // Datos personales
            $table->string('first_name', 100);
            $table->string('second_name', 100)->nullable();
            $table->string('first_surname', 100);
            $table->string('second_surname', 100)->nullable();
            $table->date('birthdate')->nullable();
            $table->string('gender', 20)->nullable();
            $table->string('blood_type', 10)->nullable();
            $table->string('profession', 100)->nullable();

            // Documentos de identificación
            $table->string('dpi', 20)->nullable()->unique();
            $table->string('nit', 20)->nullable()->unique();

            // Contacto
            $table->string('email', 150)->nullable()->unique();
            $table->string('phone_number', 20)->nullable();
            $table->string('secondary_phone_numer', 20)->nullable();
            $table->text('address')->nullable();

            // 1 = activo, 0 = inactivo
            $table->smallInteger('status')->default(1);

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('creation_date')->useCurrent();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamp('modification_date')->useCurrent()->useCurrentOnUpdate();

            // Índices
            $table->index('status');
            $table->index('first_surname');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_persons');
    }
};
