<?php

namespace App\Services;

use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Repositories\WorkerRepository;
use Illuminate\Database\Eloquent\Collection;

class WorkerService
{
    public function __construct(
        protected WorkerRepository $repository,
    ) {
    }

    public function findById(string $id): ?object
    {
        return $this->repository->findById($id);
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
