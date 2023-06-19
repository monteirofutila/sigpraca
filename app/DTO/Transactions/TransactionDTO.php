<?php

namespace App\DTO\Transactions;

class TransactionDTO
{
    public function __construct(
        public string $code_number,
        public string $user_id,
        public string $account_id,
        public ?string $description,
        public float $amount,
        public float $previous_balance,
        public float $current_balance,
        public string $model_id,
        public string $model_type,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

}