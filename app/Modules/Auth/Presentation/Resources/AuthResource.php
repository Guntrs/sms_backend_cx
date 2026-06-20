<?php

declare(strict_types=1);

namespace App\Modules\Auth\Presentation\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

// Transforma el usuario autenticado a JSON limpio
final class AuthResource extends JsonResource
{
    private string $token;

    public function __construct(mixed $resource, string $token = '')
    {
        parent::__construct($resource);
        $this->token = $token;
    }

    public function toArray(Request $request): array
    {
        return [
            'user' => [
                'id'        => $this->user_id,
                'user_name' => $this->user_name,
                'full_name' => $this->user_full_name,
                'email'     => $this->user_email,
                'phone'     => $this->user_phone,
                'status'    => $this->status,
            ],
            'token' => $this->token,
        ];
    }
}
