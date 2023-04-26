<?php

namespace App\DTO\Users;

use App\Http\Requests\UpdateUserRequest;

class UpdateUserDTO
{
    public function __construct(
        public string $subject,
        public string $body,
    ) {
    }

    public static function makeFromRequest(UpdateUserRequest $request): self
    {
        return new self(
            $request->subject,
            $request->body
        );
    }
}
