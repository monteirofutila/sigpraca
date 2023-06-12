<?php

namespace App\DTO\Credits;

use App\Http\Requests\StoreCreditRequest;


class CreditDTO
{
    public function __construct(
        public ?string $account_id,
        public ?string $description,
        public float $value,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

}