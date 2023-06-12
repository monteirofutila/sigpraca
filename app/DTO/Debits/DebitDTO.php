<?php

namespace App\DTO\Debits;

use App\Http\Requests\StoreDebitRequest;


class DebitDTO
{
    public function __construct(
        public ?string $account_id,
        public ?string $description,
        public float $amount,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

}