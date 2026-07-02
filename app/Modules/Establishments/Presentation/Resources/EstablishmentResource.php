<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este Resource.
namespace App\Modules\Establishments\Presentation\Resources;

// Importa la clase Request de Laravel.
use Illuminate\Http\Request;

// Importa la clase base JsonResource de Laravel.
use Illuminate\Http\Resources\Json\JsonResource;

/*
|--------------------------------------------------------------------------
| EstablishmentResource
|--------------------------------------------------------------------------
| Resource encargado de transformar una entidad Establishment
| en un arreglo que será devuelto como respuesta JSON.
*/
final class EstablishmentResource extends JsonResource
{
    // Convierte la entidad en un arreglo para la respuesta de la API.
    public function toArray(Request $request): array
    {
        return [

            // ID del establecimiento.
            'establishment_id' => $this->establishmentId,

            // Identificador único del establecimiento.
            'establishment_key' => $this->establishmentKey,

            // ID del establecimiento padre.
            'parent_establishment_id' => $this->parentEstablishmentId,

            // Nombre del establecimiento.
            'establishment_name' => $this->establishmentName,

            // NIT del establecimiento.
            'establishment_nit' => $this->establishmentNit,

            // Descripción del establecimiento.
            'establishment_description' => $this->establishmentDescription,

            // Dirección del establecimiento.
            'establishment_address' => $this->establishmentAddress,

            // Correo electrónico del establecimiento.
            'establishment_email' => $this->establishmentEmail,

            // Teléfono del establecimiento.
            'establishment_phone' => $this->establishmentPhone,

            // Tipo de establecimiento.
            'establishment_type' => $this->establishmentType,

            // Estado del establecimiento.
            'status' => $this->status,

            // Usuario que creó el registro.
            'created_by' => $this->createdBy,

            // Fecha de creación.
            'creation_date' => $this->creationDate,

            // Usuario que realizó la última modificación.
            'modified_by' => $this->modifiedBy,

            // Fecha de la última modificación.
            'modification_date' => $this->modificationDate,
        ];
    }
}
