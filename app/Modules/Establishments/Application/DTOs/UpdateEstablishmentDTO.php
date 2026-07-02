<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este DTO.
namespace App\Modules\Establishments\Application\DTOs;

// Importa la clase Request de Laravel.
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| UpdateEstablishmentDTO
|--------------------------------------------------------------------------
| DTO que encapsula los datos necesarios para actualizar un establecimiento.
*/
final class UpdateEstablishmentDTO
{
    // Constructor que inicializa las propiedades del DTO.
    public function __construct(
        // Nombre del establecimiento (opcional).
        public readonly ?string $establishmentName        = null,

        // ID del establecimiento padre (opcional).
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

        // Tipo de establecimiento (opcional).
        public readonly ?string $establishmentType        = null,

        // Estado del establecimiento (opcional).
        public readonly ?int    $status                   = null,

        // Usuario que realiza la modificación.
        public readonly ?int    $modifiedBy               = null,
    ) {}

    /*
     * Crea una instancia del DTO utilizando únicamente
     * los datos validados provenientes del FormRequest.
     */
    public static function fromRequest(Request $request): self
    {
        return new self(
            // Obtiene el nombre validado.
            establishmentName:        $request->validated('establishment_name'),

            // Obtiene el establecimiento padre validado.
            parentEstablishmentId:    $request->validated('parent_establishment_id'),

            // Obtiene el NIT validado.
            establishmentNit:         $request->validated('establishment_nit'),

            // Obtiene la descripción validada.
            establishmentDescription: $request->validated('establishment_description'),

            // Obtiene la dirección validada.
            establishmentAddress:     $request->validated('establishment_address'),

            // Obtiene el correo validado.
            establishmentEmail:       $request->validated('establishment_email'),

            // Obtiene el teléfono validado.
            establishmentPhone:       $request->validated('establishment_phone'),

            // Obtiene el tipo validado.
            establishmentType:        $request->validated('establishment_type'),

            // Convierte el estado a entero si fue enviado; de lo contrario mantiene null.
            status:                   $request->validated('status') !== null
                                          ? (int) $request->validated('status')
                                          : null,

            // Obtiene el ID del usuario autenticado que realiza la modificación.
            modifiedBy:               $request->user()?->user_id,
        );
    }
}
