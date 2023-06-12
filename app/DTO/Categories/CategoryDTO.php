<?php

namespace App\DTO\Categories;

use App\Http\Requests\CategoryRequest;

class CategoryDTO
{
    public function __construct(
        public string $name,
        public ?string $description,
        public string $payment_period,
        public float $debit_amount,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(CategoryRequest $request): self
    {
        return new self(
            $request->name,
            $request->description,
            $request->payment_period,
            $request->debit_amount,
        );
    }
}