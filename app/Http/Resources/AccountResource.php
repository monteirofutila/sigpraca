<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AccountResource extends JsonResource
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
            'category' => $this->whenLoaded('category', function () {
                return [
                    'name' => $this->category->name,
                    'credit' => $this->category->credit,
                    'debit' => $this->category->debit,
                ];
            }),
            'description' => $this->description,
            'balance' => $this->balance,
            'worker' => new WorkerResource($this->whenLoaded('worker')),
            'transactions' => TransactionResource::collection($this->whenLoaded('transactions')),
        ];
    }
}