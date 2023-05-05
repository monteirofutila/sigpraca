<?php

namespace App\DTO\Categories;

use App\Http\Requests\StoreCategoryRequest;

class CategoryDTO
{
    public function __construct(
        public string $name,
        public string $description,
        public float $credit,
        public float $debit,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => str_replace('_', '', $property), array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreCategoryRequest $request): self
    {
        return new self(
            $request->name,
            $request->description,
            $request->credit,
            $request->debit,
        );
    }
}