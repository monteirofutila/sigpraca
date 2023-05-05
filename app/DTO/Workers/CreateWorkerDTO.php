<?php

namespace App\DTO\Workers;

use App\Http\Requests\StoreWorkerRequest;

class CreateWorkerDTO
{
    public function __construct(
        public string $name,
        public string $email,
        //public string $photo,
        public string $phone_mobile,
        public string $phone_other,
        public string $address_country,
        public string $address_state,
        public string $address_city,
        public string $address_street,
        public $date_birth,
        public string $gender,
        public string $bi,
    ) {
    }

    public function toArray(): array
    {
        $properties = get_object_vars($this);
        $keys = array_map(fn($property) => $property, array_keys($properties));
        return array_combine($keys, $properties);
    }

    public static function makeFromRequest(StoreWorkerRequest $request): self
    {
        return new self(
            $request->name,
            $request->email,
            //$request->photo,
            $request->phone_mobile,
            $request->phone_other,
            $request->address_country,
            $request->address_state,
            $request->address_city,
            $request->address_street,
            $request->date_birth,
            $request->gender,
            $request->bi,
        );
    }
}
