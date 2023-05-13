<?php

namespace App\Services;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ServerException;
use App\Helpers\FunctionHelper;
use App\Repositories\UserRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

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
        DB::beginTransaction();

        try {
            $dto->password = bcrypt($dto->password);

            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'users');
                $dto->photo = $image_path;
            }

            $user = $this->repository->new($dto->toArray());

            DB::commit();

            return $user;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function update(UpdateUserDTO $dto, string $id): ?object
    {
        DB::beginTransaction();

        try {

            if ($dto->password) {
                $dto->password = bcrypt($dto->password);
            }

            $user = $this->repository->findById($id);

            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'users');
                $dto->photo = $image_path;
                FunctionHelper::deletePhoto($user->photo);
            }

            $data = $this->repository->update($id, $dto->toArray());
            throw_if(!$data, new ResourceNotFoundException);

            DB::commit();

            return $data;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function delete(string $id): bool
    {
        $data = $this->repository->delete($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

    public function getRoles(string $userID): ?object
    {
        $data = $this->repository->getRoles($userID);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

    public function getPermissions(string $userID): ?object
    {
        $data = $this->repository->getPermissions($userID);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }
}