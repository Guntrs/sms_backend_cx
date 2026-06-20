<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_establishment', function (Blueprint $table) {
            // PK
            $table->bigIncrements('establishment_id');

            // Clave única de negocio
            $table->string('establishment_key', 50)->unique();

            // Auto-referencia para jerarquía de sucursales
            $table->unsignedBigInteger('parent_establishment_id')->nullable();

            // Datos del establecimiento
            $table->string('establishment_name', 150);
            $table->string('establishment_nit', 30)->nullable()->unique();
            $table->text('establishment_description')->nullable();
            $table->text('establishment_address')->nullable();
            $table->string('establishment_email', 150)->nullable();
            $table->string('establishment_phone', 20)->nullable();
            $table->string('establishment_type', 50)->nullable();

            // 1 = activo, 0 = inactivo
            $table->smallInteger('status')->default(1);

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('creation_date')->useCurrent();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamp('modification_date')->useCurrent()->useCurrentOnUpdate();

            // FK auto-referencia
            $table->foreign('parent_establishment_id')
                  ->references('establishment_id')
                  ->on('sms_establishment')
                  ->nullOnDelete();

            // Índices
            $table->index('status');
            $table->index('establishment_type');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_establishment');
    }
};
