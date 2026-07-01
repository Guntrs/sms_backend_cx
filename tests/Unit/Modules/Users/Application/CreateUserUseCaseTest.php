<?php

declare(strict_types=1);

namespace Tests\Unit\Modules\Users\Application;

use App\Modules\Users\Application\DTOs\CreateUserDTO;
use App\Modules\Users\Application\UseCases\CreateUserUseCase;
use App\Modules\Users\Domain\Contracts\UserRepositoryInterface;
use App\Modules\Users\Domain\Entities\User;
use App\Modules\Users\Domain\Exceptions\UserAlreadyExistsException;
use Mockery;
use Mockery\MockInterface;
use Tests\TestCase;

class CreateUserUseCaseTest extends TestCase
{
    private UserRepositoryInterface|MockInterface $repository;
    private CreateUserUseCase $useCase;

    protected function setUp(): void
    {
        parent::setUp();

        // Mockeamos el repositorio para aislar el UseCase
        // No tocamos base de datos en tests unitarios
        $this->repository = Mockery::mock(UserRepositoryInterface::class);
        $this->useCase    = new CreateUserUseCase($this->repository);
    }

    /** @test */
    public function it_creates_a_user_successfully(): void
    {
        // Arrange — preparamos el escenario
        $dto = new CreateUserDTO(
            person_id: 1,
            user_name: 'jperez',
            email:     'juan@test.com',
            password:  'Password1*',
        );

        // El repositorio no encuentra email ni username duplicados
        $this->repository
            ->shouldReceive('findByEmail')
            ->once()
            ->with($dto->email)
            ->andReturn(null);

        $this->repository
            ->shouldReceive('findByUsername')
            ->once()
            ->with($dto->user_name)
            ->andReturn(null);

        // El repositorio crea y devuelve la entidad
        $this->repository
            ->shouldReceive('create')
            ->once()
            ->andReturn(new User(
                user_id:           1,
                person_id:         1,
                user_name:         'jperez',
                email:             'juan@test.com',
                status:            true,
                creation_date:     null,
                modification_date: null,
            ));

        // Act — ejecutamos el caso de uso
        $user = $this->useCase->execute($dto);

        // Assert — verificamos el resultado
        $this->assertEquals('jperez', $user->user_name);
        $this->assertEquals('juan@test.com', $user->email);
        $this->assertTrue($user->status);
    }

    /** @test */
    public function it_throws_exception_when_email_already_exists(): void
    {
        // Arrange
        $this->expectException(UserAlreadyExistsException::class);

        $dto = new CreateUserDTO(
            person_id: 1,
            user_name: 'jperez',
            email:     'juan@test.com',
            password:  'Password1*',
        );

        // El repositorio encuentra un usuario con ese email
        $this->repository
            ->shouldReceive('findByEmail')
            ->once()
            ->andReturn(new User(
                user_id:           2,
                person_id:         1,
                user_name:         'otro',
                email:             'juan@test.com',
                status:            true,
                creation_date:     null,
                modification_date: null,
            ));

        // Act — debe lanzar excepción
        $this->useCase->execute($dto);
    }

    /** @test */
    public function it_throws_exception_when_username_already_exists(): void
    {
        // Arrange
        $this->expectException(UserAlreadyExistsException::class);

        $dto = new CreateUserDTO(
            person_id: 1,
            user_name: 'jperez',
            email:     'juan@test.com',
            password:  'Password1*',
        );

        // Email libre pero username duplicado
        $this->repository
            ->shouldReceive('findByEmail')
            ->once()
            ->andReturn(null);

        $this->repository
            ->shouldReceive('findByUsername')
            ->once()
            ->andReturn(new User(
                user_id:           3,
                person_id:         2,
                user_name:         'jperez',
                email:             'otro@test.com',
                status:            true,
                creation_date:     null,
                modification_date: null,
            ));

        // Act — debe lanzar excepción
        $this->useCase->execute($dto);
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
