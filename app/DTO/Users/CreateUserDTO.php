<?php

namespace App\DTO\Users;

use App\Http\Requests\StoreUserRequest;

class CreateUserDTO
{
    public function __construct(
        public string $subject,
        public string $body,
    ) {
    }

    public static function makeFromRequest(StoreUserRequest $request): self
    {
        return new self(
            $request->subject,
            $request->body
        );
    }
}
