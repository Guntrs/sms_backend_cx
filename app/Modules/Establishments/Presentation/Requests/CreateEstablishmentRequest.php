<?php

declare(strict_types=1);

namespace App\Modules\Establishments\Presentation\Requests;

use App\Modules\Establishments\Domain\Rules\EstablishmentType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Valida los datos recibidos para crear un establecimiento.
 *
 * Su responsabilidad es garantizar que la información enviada
 * por el cliente cumpla las reglas básicas de formato, longitud,
 * unicidad e integridad antes de llegar a la lógica de negocio.
 */
final class CreateEstablishmentRequest extends FormRequest
{
    /**
     * Determina si el usuario puede realizar esta petición.
     *
     * La autorización se delega a otra capa (por ejemplo, Policies
     * o Middleware), por lo que aquí siempre se permite.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Define las reglas de validación para la creación
     * de un establecimiento.
     */
    public function rules(): array
    {
        return [

            // Nombre obligatorio, texto, longitud máxima
            // y único dentro de la tabla.
            'establishment_name' => [
                'required',
                'string',
                'max:200',
                'unique:sms_establishment,establishment_name'
            ],

            // Establecimiento padre opcional.
            // Si se envía, debe existir en la base de datos.
            'parent_establishment_id' => [
                'nullable',
                'integer',
                'exists:sms_establishment,establishment_id'
            ],

            // NIT opcional, con longitud máxima
            // y sin duplicados.
            'establishment_nit' => [
                'nullable',
                'string',
                'max:50',
                'unique:sms_establishment,establishment_nit'
            ],

            // Descripción opcional.
            'establishment_description' => [
                'nullable',
                'string'
            ],

            // Dirección opcional con longitud máxima.
            'establishment_address' => [
                'nullable',
                'string',
                'max:300'
            ],

            // Correo electrónico opcional con formato válido.
            'establishment_email' => [
                'nullable',
                'email',
                'max:150'
            ],

            // Teléfono opcional con longitud máxima.
            'establishment_phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            // Tipo de establecimiento obligatorio.
            // Debe pertenecer al conjunto de tipos permitidos
            // definido por las reglas del dominio.
            'establishment_type' => [
                'required',
                'integer',
                Rule::in(EstablishmentType::values()),
            ],

            // El estado no se recibe desde el cliente.
            // Se asigna automáticamente por la lógica del dominio.
        ];
    }
}
