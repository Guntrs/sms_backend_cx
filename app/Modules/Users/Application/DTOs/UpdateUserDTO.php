<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\DTOs;

use Illuminate\Http\Request;

/**
 * DTO para la actualización de usuarios.
 *
 * Transporta los datos necesarios para actualizar un usuario
 * desde la capa Presentation hacia la capa Application,
 * evitando pasar directamente el objeto Request.
 */
final class UpdateUserDTO
{
    /**
     * Inicializa el DTO con la información necesaria
     * para actualizar un usuario.
     */
    public function __construct(

        /** Nombre completo del usuario. */
        public readonly ?string $userFullName = null,

        /** Correo electrónico del usuario. */
        public readonly ?string $userEmail = null,

        /** Número telefónico del usuario. */
        public readonly ?string $userPhone = null,

        /** Número profesional o colegiado. */
        public readonly ?string $professionalNumber = null,

        /** Firma digital del usuario. */
        public readonly ?string $signature = null,

        /** URL de la imagen del usuario. */
        public readonly ?string $imageUrl = null,

        /** Estado del usuario. */
        public readonly ?int $status = null,

        /** Nueva contraseña del usuario. */
        public readonly ?string $password = null,

        /** Usuario que realiza la modificación. */
        public readonly ?int $modifiedBy = null,
    ) {}

    /**
     * Crea una instancia del DTO a partir de un Request validado.
     *
     * Extrae únicamente los datos validados y los convierte
     * en un objeto inmutable para ser utilizado por la capa
     * Application.
     *
     * @param Request $request Solicitud HTTP previamente validada.
     *
     * @return self Nueva instancia del DTO.
     */
    public static function fromRequest(Request $request): self
    {
        return new self(
            userFullName:       $request->validated('user_full_name'),
            userEmail:          $request->validated('user_email'),
            userPhone:          $request->validated('user_phone'),
            professionalNumber: $request->validated('professional_number'),
            signature:          $request->validated('signature'),
            imageUrl:           $request->validated('image_url'),
            status:             $request->validated('status') !== null
                                    ? (int) $request->validated('status')
                                    : null,
            password:           $request->validated('password'),
            modifiedBy:         $request->user()?->user_id,
        );
    }
}
