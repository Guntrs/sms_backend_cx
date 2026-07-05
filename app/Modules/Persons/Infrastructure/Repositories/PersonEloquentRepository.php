<?php

declare(strict_types=1);

namespace App\Modules\Persons\Infrastructure\Repositories;

use App\Modules\Persons\Domain\Contracts\PersonRepositoryInterface;
use App\Modules\Persons\Domain\Entities\Person;
use App\Modules\Persons\Infrastructure\Persistence\SmsPersonEloquentModel;
use Illuminate\Support\Str;

final class PersonEloquentRepository implements PersonRepositoryInterface
{
    private const WITH = ['statusTypology', 'genderTypology', 'bloodTypeTypology', 'professionTypology'];

    public function findById(int $id): ?Person
    {
        $model = SmsPersonEloquentModel::with(self::WITH)->find($id);

        return $model ? $this->toDomain($model) : null;
    }

    public function findByDpi(string $dpi): ?Person
    {
        $model = SmsPersonEloquentModel::with(self::WITH)->where('dpi', $dpi)->first();

        return $model ? $this->toDomain($model) : null;
    }

    public function findByEmail(string $email): ?Person
    {
        $model = SmsPersonEloquentModel::with(self::WITH)->where('email', $email)->first();

        return $model ? $this->toDomain($model) : null;
    }

    public function create(array $data): Person
    {
        $data['person_key'] = 'P-' . Str::upper(Str::random(8));
        $data['creation_date'] = now();

        $model = SmsPersonEloquentModel::create($data);
        $model->load(self::WITH);

        return $this->toDomain($model);
    }

    public function update(int $id, array $data): Person
    {
        $model = SmsPersonEloquentModel::findOrFail($id);

        $data['modification_date'] = now();

        $model->update($data);
        $model = $model->fresh(self::WITH);

        return $this->toDomain($model);
    }

    public function delete(int $id): bool
    {
        $model = SmsPersonEloquentModel::findOrFail($id);

        return (bool) $model->delete();
    }

    public function paginate(int $perPage = 15): mixed
    {
        $paginator = SmsPersonEloquentModel::with(self::WITH)
            ->orderBy('person_id')
            ->paginate($perPage);

        $paginator->through(fn ($model) => $this->toDomain($model));

        return $paginator;
    }

    private function toDomain(SmsPersonEloquentModel $model): Person
    {
        return new Person(
            id: $model->person_id,
            personKey: $model->person_key,
            firstName: $model->first_name,
            secondName: $model->second_name,
            firstSurname: $model->first_surname,
            secondSurname: $model->second_surname,
            birthdate: $model->birthdate?->format('Y-m-d'),
            gender: $model->gender,
            genderName: $model->genderTypology?->description,
            bloodType: $model->blood_type,
            bloodTypeName: $model->bloodTypeTypology?->description,
            profession: $model->profession,
            professionName: $model->professionTypology?->description,
            dpi: $model->dpi,
            nit: $model->nit,
            email: $model->email,
            phoneNumber: $model->phone_number,
            secondaryPhoneNumber: $model->secondary_phone_number,
            address: $model->address,
            status: $model->status,
            statusName: $model->statusTypology?->description,
            createdBy: $model->created_by,
            creationDate: $model->creation_date?->toDateTimeString(),
            modifiedBy: $model->modified_by,
            modificationDate: $model->modification_date?->toDateTimeString(),
        );
    }
}
