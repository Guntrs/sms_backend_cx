<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Transforma una entidad de establecimiento
 * en la estructura JSON que será enviada
 * como respuesta de la API.
 *
 * Su responsabilidad es definir únicamente
 * el formato de salida de los datos.
 */
final class EstablishmentResource extends JsonResource
{
    /**
     * Convierte la entidad del dominio en un arreglo
     * listo para serializar como respuesta JSON.
     */
    public function toArray(Request $request): array
    {
        return [

            // Identificador del establecimiento.
            'establishment_id' => $this->establishmentId,

            // Clave única del establecimiento.
            'establishment_key' => $this->establishmentKey,

            // Identificador del establecimiento padre.
            'parent_establishment_id' => $this->parentEstablishmentId,

            // Nombre del establecimiento.
            'establishment_name' => $this->establishmentName,

            // NIT del establecimiento.
            'establishment_nit' => $this->establishmentNit,

            // Descripción del establecimiento.
            'establishment_description' => $this->establishmentDescription,

            // Dirección del establecimiento.
            'establishment_address' => $this->establishmentAddress,

            // Correo electrónico.
            'establishment_email' => $this->establishmentEmail,

            // Teléfono de contacto.
            'establishment_phone' => $this->establishmentPhone,

            // Tipo de establecimiento:
            // identificador + nombre descriptivo.
            'establishment_type' => [
                'id'   => $this->establishmentType,
                'name' => $this->establishmentTypeName,
            ],

            // Estado del establecimiento:
            // identificador + nombre descriptivo.
            'status' => [
                'id'   => $this->status,
                'name' => $this->statusName,
            ],

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
