<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TransactionResource extends JsonResource
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
            'code_number' => $this->code_number,
            'description' => $this->description,
            'amount' => $this->amount,
            'previous_balance' => $this->previous_balance,
            'current_balance' => $this->current_balance,
            'created_at' => $this->created_at->format('Y-m-d H:i:s'),
            'account' => new AccountResource($this->whenLoaded('account')),
            'user' => new UserResource($this->whenLoaded('user')),
        ];
    }
}