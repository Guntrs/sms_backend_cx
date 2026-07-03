<?php

declare(strict_types=1);

namespace App\Modules\Users\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Modules\Users\Domain\Rules\UserStatus;
/**
 * Request para la actualización de usuarios.
 *
 * Se encarga de autorizar la petición y validar
 * los datos enviados por el cliente antes de que
 * lleguen a la capa Application.
 */
final class UpdateUserRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado
     * para realizar esta petición.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Permite que la petición continúe.
        // La autorización específica puede realizarse
        // mediante Policies o Middleware.
        return true;
    }

    /**
     * Define las reglas de validación para actualizar
     * un usuario.
     *
     * Laravel validará automáticamente estos datos
     * antes de ejecutar el controlador.
     *
     * @return array Reglas de validación.
     */
    public function rules(): array
    {
        // Obtiene el identificador del usuario enviado
        // en la ruta (por ejemplo: PUT /users/{user}).
        $userId = $this->route('user');

        return [

            // Nombre completo.
            'user_full_name' => [
                'nullable',
                'string',
                'max:200',
            ],

            // Correo electrónico.
            'user_email' => [
                'nullable',
                'email',
                'max:150',

                // Debe ser único, excepto para el mismo usuario
                // que está siendo actualizado.
                Rule::unique('sms_users', 'user_email')
                    ->ignore($userId, 'user_id'),
            ],

            // Teléfono.
            'user_phone' => [
                'nullable',
                'string',
                'max:20',
            ],

            // Número profesional.
            'professional_number' => [
                'nullable',
                'string',
                'max:50',
            ],

            // Firma.
            'signature' => [
                'nullable',
                'string',
            ],

            // URL de la imagen.
            'image_url' => [
                'nullable',
                'string',
                'max:500',
            ],

            // Estado del usuario: solo Activo (501), Inactivo (502) o Suspendido (503).
            'status' => [
                'nullable',
                'integer',
                Rule::in(UserStatus::values()),
            ],

            // Nueva contraseña.
            'password' => [
                'nullable',
                'string',
                'min:8',
            ],
        ];
    }
}
