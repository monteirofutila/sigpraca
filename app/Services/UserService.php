<?php

namespace App\Services;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use App\Exceptions\ForbiddenException;
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
        throw_if(!auth()->user()->can('users-read'), new ForbiddenException);

        $data = $this->repository->findById($id);
        throw_if(!$data, new ResourceNotFoundException);

        return $data;
    }

    public function getAll(): Collection
    {
        throw_if(!auth()->user()->can('users-read'), new ForbiddenException);
        return $this->repository->getAll();
    }

    public function new(CreateUserDTO $dto): ?object
    {
        throw_if(!auth()->user()->can('users-create'), new ForbiddenException);

        DB::beginTransaction();

        try {
            $dto->password = bcrypt($dto->password);

            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'users');
                $dto->photo = $image_path;
            }

            $prefix = strtoupper(substr($dto->role, 0, 2));

            $data = $dto->toArray();
            $data['code_number'] = FunctionHelper::generateCodeNumber($prefix);

            $user = $this->repository->new($data);
            $user->assignRole($dto->role);

            DB::commit();

            return $user;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function update(UpdateUserDTO $dto, string $id): ?object
    {
        throw_if(!auth()->user()->can('users-update'), new ForbiddenException);

        DB::beginTransaction();

        try {

            if ($dto->password) {
                $dto->password = bcrypt($dto->password);
            }

            $user = $this->repository->findById($id);

            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'users');
                $dto->photo = $image_path;
                if ($user->photo) {
                    FunctionHelper::deletePhoto($user->photo);
                }
            } else {
                $dto->photo = $user->photo;
            }

            $user = $this->repository->update($user->id, $dto->toArray());
            throw_if(!$user, new ResourceNotFoundException);

            $user->syncRoles($dto->role);

            DB::commit();

            return $user;
        } catch (ResourceNotFoundException) {
            throw new ResourceNotFoundException;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function delete(string $id): bool
    {
        throw_if(!auth()->user()->can('users-delete'), new ForbiddenException);

        $user = $this->repository->findById($id);
        throw_if(!$user, new ResourceNotFoundException);

        return $this->repository->delete($user->id);
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