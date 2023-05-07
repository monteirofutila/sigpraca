<?php

namespace App\DTO\Accounts;

use App\Http\Requests\StoreAccountRequest;


class AccountDTO
{
    public function __construct(
        public string $worker_id,
        public string $category_id,
        public string $description,
        public float $balance,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreAccountRequest $request): self
    {
        return new self(
            $request->worker_id,
            $request->category_id,
            $request->description,
            $request->balance,
        );
    }
}