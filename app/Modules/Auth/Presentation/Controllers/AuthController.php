<?php

declare(strict_types=1);

namespace App\Modules\Auth\Presentation\Controllers;

use App\Http\Controllers\Controller;
use App\Modules\Auth\Application\DTOs\LoginDTO;
use App\Modules\Auth\Application\UseCases\LoginUseCase;
use App\Modules\Auth\Application\UseCases\LogoutUseCase;
use App\Modules\Auth\Application\UseCases\GetCurrentUserUseCase;
use App\Modules\Auth\Domain\Exceptions\InvalidCredentialsException;
use App\Modules\Auth\Presentation\Requests\LoginRequest;
use App\Modules\Auth\Presentation\Resources\AuthResource;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

// Recibe el request, llama al UseCase y devuelve la respuesta
final class AuthController extends Controller
{
    public function __construct(
        private readonly LoginUseCase          $loginUseCase,
        private readonly LogoutUseCase         $logoutUseCase,
        private readonly GetCurrentUserUseCase $getCurrentUserUseCase,
    ) {}

    // POST /api/v1/auth/login
    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $result = $this->loginUseCase->execute(
                LoginDTO::fromRequest($request)
            );

            return (new AuthResource($result['user'], $result['token']))
                ->response()
                ->setStatusCode(200);

        } catch (InvalidCredentialsException $e) {
            return response()->json(['message' => $e->getMessage()], 401);
        }
    }

    // POST /api/v1/auth/logout
    public function logout(Request $request): JsonResponse
    {
        $this->logoutUseCase->execute($request->user());

        return response()->json(['message' => 'Sesión cerrada correctamente.']);
    }

    // GET /api/v1/auth/me
    public function me(Request $request): JsonResponse
    {
        $user = $this->getCurrentUserUseCase->execute($request->user()->user_id);

        return (new AuthResource($user))->response();
    }
}
