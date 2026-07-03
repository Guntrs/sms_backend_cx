<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Application\DTOs;

use App\Modules\Establishments\Domain\Rules\EstablishmentStatus;
use Illuminate\Http\Request;

/**
 * DTO que transporta los datos necesarios para crear
 * un establecimiento desde la capa de Presentación
 * hacia la capa de Aplicación.
 *
 * Su objetivo es desacoplar la lógica de negocio del
 * objeto Request de Laravel.
 */
final class CreateEstablishmentDTO
{
    /**
     * Crea una instancia inmutable con la información
     * necesaria para registrar un establecimiento.
     */
    public function __construct(
        // Nombre del establecimiento.
        public readonly string  $establishmentName,

        // Tipo de establecimiento (typology_id del catálogo de sectores).
        public readonly int     $establishmentType,

        // Establecimiento padre (opcional).
        public readonly ?int    $parentEstablishmentId    = null,

        // NIT del establecimiento (opcional).
        public readonly ?string $establishmentNit         = null,

        // Descripción del establecimiento (opcional).
        public readonly ?string $establishmentDescription = null,

        // Dirección del establecimiento (opcional).
        public readonly ?string $establishmentAddress     = null,

        // Correo electrónico del establecimiento (opcional).
        public readonly ?string $establishmentEmail       = null,

        // Teléfono del establecimiento (opcional).
        public readonly ?string $establishmentPhone       = null,

        // Estado inicial del establecimiento.
        // Siempre se crea como Activo y no proviene del cliente.
        public readonly int     $status                   = EstablishmentStatus::ACTIVO,

        // Usuario que realiza la creación (opcional).
        public readonly ?int    $createdBy                = null,
    ) {}

    /**
     * Construye el DTO a partir de una petición validada.
     *
     * Extrae únicamente los datos permitidos y asigna
     * automáticamente los valores controlados por
     * las reglas de negocio.
     */
    public static function fromRequest(Request $request): self
    {
        return new self(
            establishmentName:        $request->validated('establishment_name'),
            establishmentType:        (int) $request->validated('establishment_type'),
            parentEstablishmentId:    $request->validated('parent_establishment_id'),
            establishmentNit:         $request->validated('establishment_nit'),
            establishmentDescription: $request->validated('establishment_description'),
            establishmentAddress:     $request->validated('establishment_address'),
            establishmentEmail:       $request->validated('establishment_email'),
            establishmentPhone:       $request->validated('establishment_phone'),

            // El estado inicial siempre es Activo.
            status:                   EstablishmentStatus::ACTIVO,

            // Obtiene el identificador del usuario autenticado.
            createdBy:                $request->user()?->user_id,
        );
    }
}
