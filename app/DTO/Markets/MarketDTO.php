<?php

namespace App\DTO\Markets;
use App\Http\Requests\StoreMarketRequest;


class MarketDTO
{
    public function __construct(
        public string $name,
        public string $address,
        public float $description,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => str_replace('_', '', $property), array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreMarketRequest $request): self
    {
        return new self(
            $request->name,
            $request->address,
            $request->description,
        );
    }
}