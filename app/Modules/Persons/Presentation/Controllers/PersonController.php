<?php

declare(strict_types=1);

namespace App\Modules\Persons\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Persons\Application\DTOs\CreatePersonDTO;
use App\Modules\Persons\Application\DTOs\UpdatePersonDTO;
use App\Modules\Persons\Application\UseCases\CreatePersonUseCase;
use App\Modules\Persons\Application\UseCases\UpdatePersonUseCase;
use App\Modules\Persons\Application\UseCases\DeletePersonUseCase;
use App\Modules\Persons\Application\UseCases\GetPersonUseCase;
use App\Modules\Persons\Application\UseCases\ListPersonsUseCase;
use App\Modules\Persons\Domain\Exceptions\PersonNotFoundException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonStatusException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonGenderException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonBloodTypeException;
use App\Modules\Persons\Domain\Exceptions\InvalidPersonProfessionException;
use App\Modules\Persons\Presentation\Requests\CreatePersonRequest;
use App\Modules\Persons\Presentation\Requests\UpdatePersonRequest;
use App\Modules\Persons\Presentation\Resources\PersonResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

final class PersonController extends Controller
{
    public function __construct(
        private readonly CreatePersonUseCase $createPersonUseCase,
        private readonly UpdatePersonUseCase $updatePersonUseCase,
        private readonly DeletePersonUseCase $deletePersonUseCase,
        private readonly GetPersonUseCase $getPersonUseCase,
        private readonly ListPersonsUseCase $listPersonsUseCase,
    ) {}

    public function index(Request $request): JsonResponse
    {
        $perPage = (int) $request->query('per_page', 15);
        $persons = $this->listPersonsUseCase->execute($perPage);

        return PersonResource::collection($persons)->response();
    }

    public function store(CreatePersonRequest $request): JsonResponse
    {
        try {
            $dto = CreatePersonDTO::fromRequest($request);
            $person = $this->createPersonUseCase->execute($dto);

            return (new PersonResource($person))
                ->response()
                ->setStatusCode(201);
        } catch (InvalidPersonGenderException|InvalidPersonBloodTypeException|InvalidPersonProfessionException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function show(int $id): JsonResponse
    {
        try {
            $person = $this->getPersonUseCase->execute($id);

            return (new PersonResource($person))->response();
        } catch (PersonNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }

    public function update(UpdatePersonRequest $request, int $id): JsonResponse
    {
        try {
            $dto = UpdatePersonDTO::fromRequest($request);
            $person = $this->updatePersonUseCase->execute($id, $dto);

            return (new PersonResource($person))->response();
        } catch (PersonNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        } catch (InvalidPersonStatusException|InvalidPersonGenderException|InvalidPersonBloodTypeException|InvalidPersonProfessionException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }
    }

    public function destroy(int $id): JsonResponse
    {
        try {
            $this->deletePersonUseCase->execute($id);

            return response()->json(['message' => 'Person deleted successfully']);
        } catch (PersonNotFoundException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }
    }
}
