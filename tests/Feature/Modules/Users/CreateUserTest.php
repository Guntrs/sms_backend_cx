<?php

declare(strict_types=1);

namespace Tests\Feature\Modules\Users;

use App\Modules\Users\Infrastructure\Persistence\SmsUserEloquentModel;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateUserTest extends TestCase
{
    // RefreshDatabase limpia la BD entre cada test
    use RefreshDatabase;

    private SmsUserEloquentModel $adminUser;

    protected function setUp(): void
    {
        parent::setUp();

        // Creamos un admin autenticado para los tests
        $this->adminUser = SmsUserEloquentModel::factory()->create([
            'user_name' => 'admin_test',
            'email'     => 'admin@test.com',
        ]);

        $this->adminUser->assignRole('admin');
    }

    /** @test */
    public function it_creates_a_user_successfully(): void
    {
        $response = $this->actingAs($this->adminUser, 'sanctum')
            ->postJson('/api/v1/users', [
                'person_id'             => 1,
                'user_name'             => 'jperez',
                'email'                 => 'juan@test.com',
                'password'              => 'Password1*',
                'password_confirmation' => 'Password1*',
                'role'                  => 'vendedor',
            ]);

        $response->assertStatus(201)
                 ->assertJsonStructure([
                     'data' => [
                         'user_id',
                         'user_name',
                         'email',
                         'status',
                     ],
                 ]);
    }

    /** @test */
    public function it_fails_when_email_is_duplicated(): void
    {
        // Creamos un usuario con ese email primero
        SmsUserEloquentModel::factory()->create([
            'email' => 'juan@test.com',
        ]);

        $response = $this->actingAs($this->adminUser, 'sanctum')
            ->postJson('/api/v1/users', [
                'person_id'             => 1,
                'user_name'             => 'jperez2',
                'email'                 => 'juan@test.com',
                'password'              => 'Password1*',
                'password_confirmation' => 'Password1*',
            ]);

        $response->assertStatus(409);
    }

    /** @test */
    public function it_fails_when_unauthenticated(): void
    {
        $response = $this->postJson('/api/v1/users', []);

        // Sin token → 401
        $response->assertStatus(401);
    }

    /** @test */
    public function it_fails_validation_when_required_fields_missing(): void
    {
        $response = $this->actingAs($this->adminUser, 'sanctum')
            ->postJson('/api/v1/users', []);

        $response->assertStatus(422)
                 ->assertJsonValidationErrors(['person_id', 'user_name', 'email', 'password']);
    }
}
