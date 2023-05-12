<?php

namespace App\Services;

use App\DTO\Accounts\AccountDTO;
use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\AccountRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\WorkerRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WorkerService
{
    public function __construct(
        protected WorkerRepository $repository,
        protected AccountRepository $accountRepository,
        protected CategoryRepository $categoryRepository,
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
        DB::beginTransaction();

        try {
            if ($dto->photo) {
                $image_path = uploadPhoto($dto->photo, 'workers');
                $dto->photo = $image_path;
            }

            $worker = $this->repository->new($dto->toArray());
            $category = $this->categoryRepository->getFirst();

            //criar conta para o trabalhador cadastrado
            $accountDTO = new AccountDTO(
                $worker->id,
                $category->id,
                null,
                0
            );

            $this->accountRepository->new($accountDTO->toArray());

            DB::commit();

            return $worker;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }

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