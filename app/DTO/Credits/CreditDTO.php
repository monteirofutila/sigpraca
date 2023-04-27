<?php

namespace App\DTO\Credits;
use App\Http\Requests\StoreCreditRequest;


class CreditDTO
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
        $keys = array_map(fn($property) => str_replace('_', '', $property), array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreCreditRequest $request): self
    {
        return new self(
            $request->account_id,
            $request->description,
            $request->value,
        );
    }
}