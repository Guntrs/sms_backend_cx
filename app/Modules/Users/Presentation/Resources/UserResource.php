<?php

declare(strict_types=1);

namespace App\Modules\Users\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Resource para la representación de usuarios.
 *
 * Se encarga de transformar la entidad User en el
 * formato JSON que será enviado como respuesta
 * al cliente.
 */
final class UserResource extends JsonResource
{
    /**
     * Convierte la entidad del dominio en un arreglo
     * que Laravel serializará automáticamente a JSON.
     *
     * @param Request $request Solicitud HTTP actual.
     *
     * @return array Datos que serán enviados al cliente.
     */
    public function toArray(Request $request): array
    {
        return [

            // Identificador del usuario.
            'user_id' => $this->userId,

            // Llave única del usuario.
            'user_key' => $this->userKey,

            // Usuario padre.
            'parent_user_id' => $this->parentUserId,

            // Persona asociada al usuario.
            'person_id' => $this->personId,

            // Nombre de usuario.
            'user_name' => $this->userName,

            // Nombre completo.
            'user_full_name' => $this->userFullName,

            // Correo electrónico.
            'user_email' => $this->userEmail,

            // Teléfono.
            'user_phone' => $this->userPhone,

            // Número profesional.
            'professional_number' => $this->professionalNumber,

            // Firma.
            'signature' => $this->signature,

            // URL de la imagen.
            'image_url' => $this->imageUrl,

            // Estado.
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
