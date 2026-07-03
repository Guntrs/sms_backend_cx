<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Application\DTOs;

use Illuminate\Http\Request;

/**
 * DTO que transporta los datos necesarios para
 * actualizar un establecimiento.
 *
 * Su responsabilidad es desacoplar la lógica de
 * negocio del objeto Request de Laravel y transportar
 * únicamente la información validada.
 */
final class UpdateEstablishmentDTO
{
    /**
     * Crea una instancia inmutable con los datos
     * que serán utilizados durante la actualización.
     */
    public function __construct(

        // Nombre del establecimiento.
        public readonly ?string $establishmentName = null,

        // Establecimiento padre.
        public readonly ?int $parentEstablishmentId = null,

        // NIT del establecimiento.
        public readonly ?string $establishmentNit = null,

        // Descripción del establecimiento.
        public readonly ?string $establishmentDescription = null,

        // Dirección del establecimiento.
        public readonly ?string $establishmentAddress = null,

        // Correo electrónico del establecimiento.
        public readonly ?string $establishmentEmail = null,

        // Teléfono del establecimiento.
        public readonly ?string $establishmentPhone = null,

        // Tipo de establecimiento (typology_id del catálogo de sectores).
        public readonly ?int $establishmentType = null,

        // Estado del establecimiento.
        public readonly ?int $status = null,

        // Usuario que realiza la modificación.
        public readonly ?int $modifiedBy = null,
    ) {}

    /**
     * Construye el DTO a partir de una petición validada.
     *
     * Extrae únicamente los datos permitidos y realiza
     * las conversiones de tipo necesarias antes de
     * enviarlos a la capa de Aplicación.
     */
    public static function fromRequest(Request $request): self
    {
        return new self(
            establishmentName:        $request->validated('establishment_name'),
            parentEstablishmentId:    $request->validated('parent_establishment_id'),
            establishmentNit:         $request->validated('establishment_nit'),
            establishmentDescription: $request->validated('establishment_description'),
            establishmentAddress:     $request->validated('establishment_address'),
            establishmentEmail:       $request->validated('establishment_email'),
            establishmentPhone:       $request->validated('establishment_phone'),

            // Convierte el tipo de establecimiento a entero
            // únicamente si fue enviado.
            establishmentType:        $request->validated('establishment_type') !== null
                                          ? (int) $request->validated('establishment_type')
                                          : null,

            // Convierte el estado a entero
            // únicamente si fue enviado.
            status:                   $request->validated('status') !== null
                                          ? (int) $request->validated('status')
                                          : null,

            // Obtiene el identificador del usuario autenticado.
            modifiedBy:               $request->user()?->user_id,
        );
    }
}
