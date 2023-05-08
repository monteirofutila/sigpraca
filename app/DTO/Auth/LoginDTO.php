<?php

namespace App\DTO\Accounts;

use App\Http\Requests\LoginRequest;


class LoginDTO
{
    public function __construct(
        public string $user_name,
        public string $password,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(LoginRequest $request): self
    {
        return new self(
            $request->user_name,
            $request->password,
        );
    }
}