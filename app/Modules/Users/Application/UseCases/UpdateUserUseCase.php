<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este caso de uso.
namespace App\Modules\Users\Application\UseCases;

// Importa el DTO con los datos necesarios para actualizar un usuario.
use App\Modules\Users\Application\DTOs\UpdateUserDTO;

// Importa el contrato del repositorio para acceder a los datos.
use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;

// Importa la entidad que será devuelta tras la actualización.
use App\Modules\Users\Domain\Entities\User;

// Importa las excepciones de la lógica de negocio.
use App\Modules\Users\Domain\Exceptions\InvalidUserStatusException;
use App\Modules\Users\Domain\Exceptions\UserNotFoundException;

// Importa la regla de negocio con los estados permitidos.
use App\Modules\Users\Domain\Rules\UserStatus;

// Importa Hash para cifrar la contraseña.
use Illuminate\Support\Facades\Hash;

/*
|--------------------------------------------------------------------------
| UpdateUserUseCase
|--------------------------------------------------------------------------
| Caso de uso encargado de ejecutar la lógica de negocio para
| actualizar un usuario existente.
*/
final class UpdateUserUseCase
{
    // Inyecta el repositorio mediante su interfaz.
    public function __construct(
        private readonly UserRepositoryInterface $userRepository
    ) {}

    // Ejecuta el proceso de actualización del usuario.
    public function execute(int $id, UpdateUserDTO $dto): User
    {
        // Busca el usuario por su ID.
        $existing = $this->userRepository->findById($id);

        // Si no existe, detiene el proceso lanzando una excepción.
        if ($existing === null) {
            throw new UserNotFoundException($id);
        }

        // Verifica que el estado enviado sea uno de los permitidos.
        if ($dto->status !== null && !in_array($dto->status, UserStatus::values(), true)) {
            throw new InvalidUserStatusException($dto->status);
        }

        // Construye el arreglo con los datos a actualizar.
        // Solo conserva los campos cuyo valor no sea null.
        $data = array_filter([

            // Nombre completo del usuario.
            'user_full_name' => $dto->userFullName,

            // Correo electrónico.
            'user_email' => $dto->userEmail,

            // Teléfono.
            'user_phone' => $dto->userPhone,

            // Número profesional.
            'professional_number' => $dto->professionalNumber,

            // Firma.
            'signature' => $dto->signature,

            // URL de la imagen.
            'image_url' => $dto->imageUrl,

            // Estado del usuario.
            'status' => $dto->status,

            // Usuario que realiza la modificación.
            'modified_by' => $dto->modifiedBy,

            // Cifra la contraseña antes de almacenarla si fue enviada.
            'password' => $dto->password !== null
                ? Hash::make($dto->password)
                : null,

        ], fn($v) => $v !== null);

        // Actualiza el usuario y devuelve la entidad actualizada.
        return $this->userRepository->update($id, $data);
    }
}
