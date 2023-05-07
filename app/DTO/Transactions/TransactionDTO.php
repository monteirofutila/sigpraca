<?php

namespace App\DTO\Transactions;

use App\Http\Requests\StoreTransactionRequest;


class TransactionDTO
{
    public function __construct(
        public string $user_id,
        public string $description,
        public float $value,
        public float $previous_balance,
        public float $current_balance,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreTransactionRequest $request): self
    {
        return new self(
            $request->user_id,
            $request->description,
            $request->value,
            $request->previous_balance,
            $request->current_balance,
        );
    }
}