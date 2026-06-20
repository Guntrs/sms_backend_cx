<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_typologies', function (Blueprint $table) {
            // PK
            $table->bigIncrements('typology_id');

            // Auto-referencia para tipologías padre (ej: categoría → subcategoría)
            $table->unsignedBigInteger('parent_typology_id')->nullable();

            $table->string('description', 150);
            $table->string('value1', 100)->nullable();
            $table->string('value2', 100)->nullable();
            $table->string('value3', 100)->nullable();

            // 1 = activo, 0 = inactivo
            $table->smallInteger('status')->default(1);

            // Auditoría
            $table->unsignedBigInteger('created_by')->nullable();
            $table->timestamp('creation_date')->useCurrent();
            $table->unsignedBigInteger('modified_by')->nullable();
            $table->timestamp('modification_date')->useCurrent()->useCurrentOnUpdate();

            // FK auto-referencia
            $table->foreign('parent_typology_id')
                  ->references('typology_id')
                  ->on('sms_typologies')
                  ->nullOnDelete();

            // Índices
            $table->index('status');
            $table->index('parent_typology_id');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_typologies');
    }
};
