<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Presentation\Requests;

use App\Modules\Establishments\Domain\Rules\EstablishmentStatus;
use App\Modules\Establishments\Domain\Rules\EstablishmentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Valida los datos recibidos para actualizar
 * un establecimiento existente.
 *
 * Su responsabilidad es garantizar que únicamente
 * se acepten datos válidos antes de ejecutar
 * la lógica de negocio.
 */
final class UpdateEstablishmentRequest extends FormRequest
{
    /**
     * Determina si el usuario puede realizar
     * esta petición.
     *
     * La autorización se delega a otra capa
     * (Policies o Middleware).
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para
     * la actualización de un establecimiento.
     */
    public function rules(): array
    {
        // Obtiene el identificador del establecimiento
        // desde el parámetro de la ruta.
        $establishmentId = $this->route('establishment');

        return [

            // Nombre opcional.
            // Si se envía, debe ser único excluyendo
            // el propio registro que se está actualizando.
            'establishment_name' => [
                'nullable',
                'string',
                'max:200',
                Rule::unique('sms_establishment', 'establishment_name')
                    ->ignore($establishmentId, 'establishment_id')
            ],

            // Establecimiento padre opcional.
            // Si se envía, debe existir.
            'parent_establishment_id' => [
                'nullable',
                'integer',
                'exists:sms_establishment,establishment_id'
            ],

            // NIT opcional.
            // Si se envía, debe ser único excepto
            // para el registro actual.
            'establishment_nit' => [
                'nullable',
                'string',
                'max:50',
                Rule::unique('sms_establishment', 'establishment_nit')
                    ->ignore($establishmentId, 'establishment_id')
            ],

            // Descripción opcional.
            'establishment_description' => [
                'nullable',
                'string'
            ],

            // Dirección opcional.
            'establishment_address' => [
                'nullable',
                'string',
                'max:300'
            ],

            // Correo electrónico opcional
            // con formato válido.
            'establishment_email' => [
                'nullable',
                'email',
                'max:150'
            ],

            // Teléfono opcional.
            'establishment_phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            // Tipo de establecimiento opcional.
            // Si se envía, debe pertenecer al conjunto
            // de tipos válidos del dominio.
            'establishment_type' => [
                'nullable',
                'integer',
                Rule::in(EstablishmentType::values()),
            ],

            // Estado opcional.
            // Si se envía, debe ser uno de los estados
            // permitidos por las reglas del dominio.
            'status' => [
                'nullable',
                'integer',
                Rule::in(EstablishmentStatus::values()),
            ],
        ];
    }
}
