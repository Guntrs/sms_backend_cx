<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_users', function (Blueprint $table) {
            // PK
            $table->bigIncrements('user_id');

            // Clave única de negocio
            $table->string('user_key', 50)->unique();

            // Auto-referencia para jerarquía de usuarios
            $table->unsignedBigInteger('parent_user_id')->nullable();

            // FK a sms_persons
            $table->unsignedBigInteger('person_id');

            // Credenciales de acceso
            $table->string('user_name', 100)->unique();
            $table->string('password', 255);
            $table->timestamp('password_change_date')->nullable();
            $table->smallInteger('access_attempt')->default(0);

            // Datos adicionales del usuario
            $table->string('user_full_name', 200)->nullable();
            $table->string('user_email', 150)->nullable()->unique();
            $table->string('user_phone', 20)->nullable();
            $table->string('professional_number', 50)->nullable();
            $table->text('signature')->nullable();
            $table->string('image_url', 255)->nullable();

            // 1 = activo, 0 = inactivo
            $table->smallInteger('status')->default(1);

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('creation_date')->useCurrent();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamp('modification_date')->useCurrent()->useCurrentOnUpdate();

            // FK a sms_persons
            $table->foreign('person_id')
                  ->references('person_id')
                  ->on('sms_persons')
                  ->restrictOnDelete();

            // FK auto-referencia
            $table->foreign('parent_user_id')
                  ->references('user_id')
                  ->on('sms_users')
                  ->nullOnDelete();

            // Índices
            $table->index('status');
            $table->index('person_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_users');
    }
};
