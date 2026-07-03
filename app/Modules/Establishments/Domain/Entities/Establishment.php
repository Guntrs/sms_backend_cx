<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Domain\Entities;

/**
 * Representa un establecimiento dentro del dominio.
 *
 * Esta entidad contiene únicamente los datos que describen
 * un establecimiento y es independiente de Laravel,
 * de la base de datos y de cualquier tecnología externa.
 */
final class Establishment
{
    /**
     * Crea una instancia inmutable de un establecimiento.
     */
    public function __construct(

        // Identificador único del establecimiento.
        public readonly int $establishmentId,

        // Clave única del establecimiento.
        public readonly string $establishmentKey,

        // Identificador del establecimiento padre (si existe).
        public readonly ?int $parentEstablishmentId,

        // Nombre del establecimiento.
        public readonly string $establishmentName,

        // Número de Identificación Tributaria (NIT).
        public readonly ?string $establishmentNit,

        // Descripción del establecimiento.
        public readonly ?string $establishmentDescription,

        // Dirección física del establecimiento.
        public readonly ?string $establishmentAddress,

        // Correo electrónico de contacto.
        public readonly ?string $establishmentEmail,

        // Teléfono de contacto.
        public readonly ?string $establishmentPhone,

        // Identificador del tipo de establecimiento.
        public readonly int $establishmentType,

        // Identificador del estado actual.
        public readonly int $status,

        // Usuario que creó el registro.
        public readonly ?int $createdBy,

        // Fecha de creación del registro.
        public readonly ?string $creationDate,

        // Usuario que realizó la última modificación.
        public readonly ?int $modifiedBy,

        // Fecha de la última modificación.
        public readonly ?string $modificationDate,

        /**
         * Nombre legible del tipo de establecimiento,
         * obtenido desde el catálogo sms_typologies.
         */
        public readonly ?string $establishmentTypeName = null,

        /**
         * Nombre legible del estado,
         * obtenido desde el catálogo sms_typologies.
         */
        public readonly ?string $statusName = null,
    ) {}
}
