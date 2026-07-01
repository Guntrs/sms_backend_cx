<?php

declare(strict_types=1);

namespace App\Modules\Users\Application\DTOs;

use Illuminate\Http\Request;

/**
 * DTO para la creación de usuarios.
 *
 * Transporta los datos necesarios para crear un usuario
 * desde la capa Presentation hacia la capa Application,
 * evitando pasar directamente el objeto Request.
 */
final class CreateUserDTO
{
    /**
     * Inicializa el DTO con la información necesaria
     * para crear un usuario.
     */
    public function __construct(

        /** Identificador de la persona asociada al usuario. */
        public readonly int $personId,

        /** Nombre de usuario para iniciar sesión. */
        public readonly string $userName,

        /** Contraseña del usuario. */
        public readonly string $password,

        /** Identificador del usuario padre o superior jerárquico. */
        public readonly ?int $parentUserId = null,

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

        /** Estado inicial del usuario. */
        public readonly int $status = 1,

        /** Usuario que realiza la creación del registro. */
        public readonly ?int $createdBy = null,
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
            personId:           (int) $request->validated('person_id'),
            userName:           $request->validated('user_name'),
            password:           $request->validated('password'),
            parentUserId:       $request->validated('parent_user_id'),
            userFullName:       $request->validated('user_full_name'),
            userEmail:          $request->validated('user_email'),
            userPhone:          $request->validated('user_phone'),
            professionalNumber: $request->validated('professional_number'),
            signature:          $request->validated('signature'),
            imageUrl:           $request->validated('image_url'),
            status:             (int) ($request->validated('status') ?? 1),
            createdBy:          $request->user()?->user_id,
        );
    }
}
