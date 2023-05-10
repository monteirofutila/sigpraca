<?php

namespace App\Services;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use App\Exceptions\ResourceNotFoundException;
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
        $data = $this->repository->findById($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;

    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function new(CreateUserDTO $dto): ?object
    {
        $dto->password = bcrypt($dto->password);

        if ($dto->photo) {
            $image_path = uploadPhoto($dto->photo, 'users');
            $dto->photo = $image_path;
        }

        return $this->repository->new($dto->toArray());
    }

    public function update(UpdateUserDTO $dto, string $id): ?object
    {
        if ($dto->password) {
            $dto->password = bcrypt($dto->password);
        }

        $user = $this->repository->findById($id);

        if ($dto->photo) {
            $image_path = uploadPhoto($dto->photo, 'users');
            $dto->photo = $image_path;
            deletePhoto($user->photo);
        }

        $data = $this->repository->update($id, $dto->toArray());
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

    public function delete(string $id): bool
    {
        $data = $this->repository->delete($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }
}