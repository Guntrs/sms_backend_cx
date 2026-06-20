<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_users_establishment', function (Blueprint $table) {
            // PK
            $table->bigIncrements('users_establishment_id');

            // FK a sms_users
            $table->unsignedBigInteger('users_id');

            // FK a sms_establishment
            $table->unsignedBigInteger('establishment_id');

            // Rol del usuario en esta sucursal (referencia a sms_typologies)
            $table->unsignedBigInteger('role')->nullable();

            // 1 = activo, 0 = inactivo
            $table->smallInteger('status')->default(1);

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('creation_date')->useCurrent();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamp('modification_date')->useCurrent()->useCurrentOnUpdate();

            // FK a sms_users
            $table->foreign('users_id')
                  ->references('user_id')
                  ->on('sms_users')
                  ->restrictOnDelete();

            // FK a sms_establishment
            $table->foreign('establishment_id')
                  ->references('establishment_id')
                  ->on('sms_establishment')
                  ->restrictOnDelete();

            // Un usuario no puede estar duplicado en la misma sucursal
            $table->unique(['users_id', 'establishment_id']);

            // Índices
            $table->index('status');
            $table->index('role');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_users_establishment');
    }
};
