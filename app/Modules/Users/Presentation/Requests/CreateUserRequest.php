<?php

declare(strict_types=1);

namespace App\Modules\Users\Presentation\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Request para la creación de usuarios.
 *
 * Se encarga de autorizar la petición y validar
 * los datos enviados por el cliente antes de que
 * lleguen a la capa Application.
 */
final class CreateUserRequest extends FormRequest
{
    /**
     * Determina si el usuario está autorizado
     * para realizar esta petición.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Permite que cualquier usuario autorizado
        // por la aplicación pueda ejecutar esta petición.
        return true;
    }

    /**
     * Define las reglas de validación de la petición.
     *
     * Laravel validará automáticamente estos datos
     * antes de ejecutar el controlador.
     *
     * @return array Reglas de validación.
     */
    public function rules(): array
    {
        return [

            // Persona asociada al usuario.
            'person_id' => [
                'required',
                'integer',
                'exists:sms_persons,person_id',
            ],

            // Nombre de usuario.
            'user_name' => [
                'required',
                'string',
                'max:100',
                'unique:sms_users,user_name',
            ],

            // Contraseña.
            'password' => [
                'required',
                'string',
                'min:8',
            ],

            // Usuario padre.
            'parent_user_id' => [
                'nullable',
                'integer',
                'exists:sms_users,user_id',
            ],

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
                'unique:sms_users,user_email',
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


        ];
    }
}
