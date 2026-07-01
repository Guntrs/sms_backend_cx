<?php

declare(strict_types=1);

namespace App\Modules\Users\Domain\Entities;

/**
 * Entidad de dominio User.
 *
 * Representa un usuario del sistema dentro de la capa Domain.
 *
 * Esta entidad es inmutable (readonly) y contiene únicamente
 * los datos propios del dominio. No conoce la base de datos,
 * HTTP, Eloquent, ni ninguna tecnología de infraestructura.
 */
final class User
{
    /**
     * Constructor de la entidad.
     *
     * Todas las propiedades son de solo lectura para garantizar
     * la inmutabilidad de la entidad una vez creada.
     */
    public function __construct(

        /** Identificador único del usuario. */
        public readonly int $userId,

        /** Clave única del usuario (UUID o identificador público). */
        public readonly string $userKey,

        /** Usuario padre o superior jerárquico. */
        public readonly ?int $parentUserId,

        /** Identificador de la persona asociada. */
        public readonly int $personId,

        /** Nombre de usuario utilizado para iniciar sesión. */
        public readonly string $userName,

        /** Nombre completo del usuario. */
        public readonly ?string $userFullName,

        /** Correo electrónico del usuario. */
        public readonly ?string $userEmail,

        /** Número telefónico del usuario. */
        public readonly ?string $userPhone,

        /** Número profesional o colegiado (si aplica). */
        public readonly ?string $professionalNumber,

        /** Firma digital o representación de la firma del usuario. */
        public readonly ?string $signature,

        /** URL de la imagen o fotografía del usuario. */
        public readonly ?string $imageUrl,

        /** Estado actual del usuario (activo, inactivo, etc.). */
        public readonly int $status,

        /** Usuario que creó el registro. */
        public readonly ?int $createdBy,

        /** Fecha de creación del registro. */
        public readonly ?string $creationDate,

        /** Usuario que realizó la última modificación. */
        public readonly ?int $modifiedBy,

        /** Fecha de la última modificación del registro. */
        public readonly ?string $modificationDate,
    ) {}
}
