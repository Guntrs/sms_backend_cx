<?php

// Activa el tipado estricto para evitar conversiones automáticas de tipos.
declare(strict_types=1);

// Define el espacio de nombres donde pertenece este FormRequest.
namespace App\Modules\Establishments\Presentation\Requests;

// Importa la clase base FormRequest de Laravel.
use Illuminate\Foundation\Http\FormRequest;

/*
|--------------------------------------------------------------------------
| CreateEstablishmentRequest
|--------------------------------------------------------------------------
| FormRequest encargado de autorizar y validar los datos recibidos
| para crear un establecimiento.
*/
final class CreateEstablishmentRequest extends FormRequest
{
    // Autoriza la ejecución de la solicitud.
    public function authorize(): bool
    {
        return true;
    }

    // Define las reglas de validación de cada campo.
    public function rules(): array
    {
        return [

            // Nombre obligatorio, máximo 200 caracteres y único.
            'establishment_name' => [
                'required',
                'string',
                'max:200',
                'unique:sms_establishment,establishment_name'
            ],

            // ID del establecimiento padre opcional y debe existir.
            'parent_establishment_id' => [
                'nullable',
                'integer',
                'exists:sms_establishment,establishment_id'
            ],

            // NIT opcional, máximo 50 caracteres y único.
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

            // Dirección opcional con máximo 300 caracteres.
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

            // Teléfono opcional con máximo 20 caracteres.
            'establishment_phone' => [
                'nullable',
                'string',
                'max:20'
            ],

            // Tipo de establecimiento opcional.
            'establishment_type' => [
                'nullable',
                'string',
                'max:50'
            ],

            // Estado opcional; solo permite 0 o 1.
            'status' => [
                'nullable',
                'integer',
                'in:0,1'
            ],
        ];
    }
}
