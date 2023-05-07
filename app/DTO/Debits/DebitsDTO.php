<?php

namespace App\DTO\Debits;

use App\Http\Requests\StoreDebitRequest;


class DebitsDTO
{
    public function __construct(
        public string $account_id,
        public string $description,
        public float $value,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreDebitRequest $request): self
    {
        return new self(
            $request->account_id,
            $request->description,
            $request->value,
        );
    }
}