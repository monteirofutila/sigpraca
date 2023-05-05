<?php

namespace App\Services;

use App\DTO\Category\CreateCategoryDTO;
use App\DTO\Workers\UpdateCategoryDTO;
use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\Collection;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $repository,
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
