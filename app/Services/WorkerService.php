<?php

namespace App\Services;

use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Exceptions\ResourceNotFoundException;
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
        $data = $this->repository->findById($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;

    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function new(CreateWorkerDTO $dto): ?object
    {
        if ($dto->photo) {
            $image_path = uploadPhoto($dto->photo, 'workers');
            $dto->photo = $image_path;
        }

        return $this->repository->new($dto->toArray());
    }

    public function update(UpdateWorkerDTO $dto, string $id): ?object
    {
        $worker = $this->repository->findById($id);

        if ($dto->photo) {
            $image_path = uploadPhoto($dto->photo, 'workers');
            $dto->photo = $image_path;
            deletePhoto($worker->photo);
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