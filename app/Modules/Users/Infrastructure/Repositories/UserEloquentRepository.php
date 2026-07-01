<?php

declare(strict_types=1);

namespace App\Modules\Users\Infrastructure\Repositories;

use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel;

final class UserEloquentRepository implements UserRepositoryInterface
{
    public function findById(int $id): ?User
    {
        $model = SmsUserEloquentModel::find($id);
        return $model ? $this->toDomain($model) : null;
    }

    public function findByUserName(string $userName): ?User
    {
        $model = SmsUserEloquentModel::where('user_name', $userName)->first();
        return $model ? $this->toDomain($model) : null;
    }

    public function findByEmail(string $email): ?User
    {
        $model = SmsUserEloquentModel::where('user_email', $email)->first();
        return $model ? $this->toDomain($model) : null;
    }

    public function create(array $data): User
    {
        $data['user_key']      = (string) \Illuminate\Support\Str::uuid();
        $data['creation_date'] = now()->toDateTimeString();
        $model                 = SmsUserEloquentModel::create($data);
        return $this->toDomain($model);
    }

    public function update(int $id, array $data): User
    {
        $data['modification_date'] = now()->toDateTimeString();
        $model                     = SmsUserEloquentModel::findOrFail($id);
        $model->update($data);
        return $this->toDomain($model->fresh());
    }

    public function delete(int $id): bool
    {
        return (bool) SmsUserEloquentModel::where('user_id', $id)->delete();
    }

    public function paginate(int $perPage = 15): mixed
    {
        return SmsUserEloquentModel::orderBy('user_id')
            ->paginate($perPage)
            ->through(fn($model) => $this->toDomain($model));
    }

    private function toDomain(SmsUserEloquentModel $model): User
    {
        return new User(
            userId:             $model->user_id,
            userKey:            $model->user_key,
            parentUserId:       $model->parent_user_id,
            personId:           $model->person_id,
            userName:           $model->user_name,
            userFullName:       $model->user_full_name,
            userEmail:          $model->user_email,
            userPhone:          $model->user_phone,
            professionalNumber: $model->professional_number,
            signature:          $model->signature,
            imageUrl:           $model->image_url,
            status:             $model->status,
            createdBy:          $model->created_by,
            creationDate:       $model->creation_date?->toDateTimeString(),
            modifiedBy:         $model->modified_by,
            modificationDate:   $model->modification_date?->toDateTimeString(),
        );
    }
}
