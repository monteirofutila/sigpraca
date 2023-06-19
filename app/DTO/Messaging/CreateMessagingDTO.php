<?php

namespace App\DTO\Messaging;

use App\Http\Requests\StoreMessagingRequest;


class CreateMessagingDTO
{
    public function __construct(
        public ?string $number,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreMessagingRequest $request): self
    {
        return new self(
            $request->number,
        );
    }
}
