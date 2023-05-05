<?php

namespace App\Services;

use App\DTO\Category\CreateMarketDTO;
use App\DTO\Workers\UpdateMarketDTO;
use App\Repositories\MarketRepository;
use Illuminate\Database\Eloquent\Collection;

class MarketService
{
    public function __construct(
        protected MarketRepository $repository,
    ) {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function new(CreateWorkerDTO $dto): ?object
    {
        return $this->repository->new($dto->toArray());
    }

    public function update(UpdateWorkerDTO $dto, string $id): ?object
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}
