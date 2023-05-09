<?php

namespace App\Services;

use App\DTO\Users\UserDTO;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;

class UserService
{
    public function __construct(
        protected UserRepository $repository,
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

    public function new(UserDTO $dto): ?object
    {
        return $this->repository->new($dto->toArray());
    }

    public function update(UserDTO $dto, string $id): ?object
    {
        return $this->repository->update($id, $dto->toArray());
    }

    public function delete(string $id): bool
    {
        return $this->repository->delete($id);
    }
}