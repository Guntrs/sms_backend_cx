<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sms_customers', function (Blueprint $table) {
            // PK
            $table->bigIncrements('customer_id');

            // FK a sms_persons
            $table->unsignedBigInteger('person_id');

            // Clave única de negocio
            $table->string('customer_key', 50)->unique();

            // Datos comerciales del cliente
            $table->string('customer_full_name', 200);
            $table->string('customer_type', 50)->nullable();
            $table->string('customer_segment', 50)->nullable();

            // Control de crédito
            $table->decimal('credit_limit', 12, 2)->default(0.00);
            $table->string('currency', 10)->default('GTQ');

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

            // Índices
            $table->index('status');
            $table->index('customer_type');
            $table->index('customer_segment');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sms_customers');
    }
};
