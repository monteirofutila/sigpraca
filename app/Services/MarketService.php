<?php

namespace App\Services;

use App\DTO\Markets\MarketDTO;
use App\Repositories\MarketRepository;
use Illuminate\Database\Eloquent\Collection;

class MarketService
{
    public function __construct(
        protected MarketRepository $repository,
    ) {
    }

    public function getFirst(): Collection
    {
        return $this->repository->getFirst();
    }

    public function update(MarketDTO $dto): ?object
    {
        $market = $this->repository->getFirst();
        return $this->repository->update(
            $market->id,
            $dto->toArray()
        );
    }

}