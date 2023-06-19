<?php

namespace App\Services;

use App\DTO\Categories\CategoryDTO;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\CategoryRepository;
use Illuminate\Support\Facades\DB;
use Predis\Response\ServerException;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $repository,
    ) {
    }

    public function getFirst(): ?object
    {
        return $this->repository->getFirst();
    }

    public function findById(string $id): ?object
    {
        throw_if(!auth()->user()->can('categories-read'), new ForbiddenException);

        $data = $this->repository->findById($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

    public function getAll(): ?object
    {
        throw_if(!auth()->user()->can('categories-read'), new ForbiddenException);
        return $this->repository->getAll();
    }

    public function new(CategoryDTO $dto): ?object
    {
        throw_if(!auth()->user()->can('categories-create'), new ForbiddenException);

        DB::beginTransaction();
        try {

            $worker = $this->repository->new($dto->toArray());
            DB::commit();

            return $worker;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function update(CategoryDTO $dto, string $id): ?object
    {
        throw_if(!auth()->user()->can('categories-update'), new ForbiddenException);

        DB::beginTransaction();
        try {

            $category = $this->repository->findById($id);
            $data = $this->repository->update($id, $dto->toArray());
            throw_if(!$data, new ResourceNotFoundException);

            DB::commit();

            return $data;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function delete(string $id): bool
    {
        throw_if(!auth()->user()->can('categories-delete'), new ForbiddenException);

        $data = $this->repository->delete($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

}