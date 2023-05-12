<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'type' => 'users',
            'attributes' => [
                'name' => $this->name,
                'user_name' => $this->user_name,
                'email' => $this->email,
                'photo' => asset('storage/' . $this->photo),
                'phone_mobile' => $this->phone_mobile,
                'phone_other' => $this->phone_other,
                'address' => [
                    'address_country' => $this->address_country,
                    'address_state' => $this->address_state,
                    'address_city' => $this->address_city,
                    'address_street' => $this->address_street,
                ],
                'date_birth' => $this->date_birth,
                'gender' => $this->gender,
                'bi' => $this->bi,
                //'roles' => $this->getRolesName(),
                'permissions' => PermissionResource::collection($this->getAllPermissions()),
            ],
        ];
    }
}