<?php

namespace App\DTO\Users;

use App\Http\Requests\StoreUserRequest;

class CreateUserDTO
{
    public function __construct(
        public string $user_name,
        public string $first_name,
        public string $last_name,
        public string $email,
        public string $password,
        public string $photo,
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

    public static function makeFromRequest(StoreUserRequest $request): self
    {
        return new self(
            $request->user_name,
            $request->first_name,
            $request->last_name,
            $request->email,
            $request->password,
            $request->photo,
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
