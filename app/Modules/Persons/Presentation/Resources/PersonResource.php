<?php

declare(strict_types=1);

namespace App\Modules\Persons\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

final class PersonResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'person_key' => $this->personKey,
            'first_name' => $this->firstName,
            'second_name' => $this->secondName,
            'first_surname' => $this->firstSurname,
            'second_surname' => $this->secondSurname,
            'full_name' => $this->fullName(),
            'birthdate' => $this->birthdate,
            'gender' => $this->gender !== null ? [
                'id' => $this->gender,
                'name' => $this->genderName,
            ] : null,
            'blood_type' => $this->bloodType !== null ? [
                'id' => $this->bloodType,
                'name' => $this->bloodTypeName,
            ] : null,
            'profession' => $this->profession !== null ? [
                'id' => $this->profession,
                'name' => $this->professionName,
            ] : null,
            'dpi' => $this->dpi,
            'nit' => $this->nit,
            'email' => $this->email,
            'phone_number' => $this->phoneNumber,
            'secondary_phone_number' => $this->secondaryPhoneNumber,
            'address' => $this->address,
            'status' => [
                'id' => $this->status,
                'name' => $this->statusName,
            ],
            'created_by' => $this->createdBy,
            'creation_date' => $this->creationDate,
            'modified_by' => $this->modifiedBy,
            'modification_date' => $this->modificationDate,
        ];
    }
}
