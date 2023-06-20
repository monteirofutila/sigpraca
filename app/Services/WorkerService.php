<?php

namespace App\Services;

use App\DTO\Accounts\AccountDTO;
use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ServerException;
use App\Helpers\FunctionHelper;
use App\Repositories\AccountRepository;
use App\Repositories\WorkerRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;

class WorkerService
{
    public function __construct(
        protected WorkerRepository $repository,
        protected AccountRepository $accountRepository,
    ) {
    }

    public function findById(string $id): ?object
    {
        throw_if(!auth()->user()->can('workers-read'), new ForbiddenException);

        $data = $this->repository->findById($id);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

    public function getAll(): Collection
    {
        throw_if(!auth()->user()->can('workers-read'), new ForbiddenException);
        return $this->repository->getAll();
    }

    public function new(CreateWorkerDTO $dto, string $categoryID): ?object
    {
        throw_if(!auth()->user()->can('workers-create'), new ForbiddenException);

        DB::beginTransaction();

        try {
            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'workers');
                $dto->photo = $image_path;
            }

            $prefix = ucfirst(substr($dto->name, 0, 1));

            $data = $dto->toArray();
            $data['code_number'] = FunctionHelper::generateCodeNumber($prefix);

            $worker = $this->repository->new($data);

            //criar conta para o trabalhador cadastrado
            $accountDTO = new AccountDTO(
                worker_id: $worker->id,
                category_id: $categoryID,
                description: null,
                balance: 0
            );

            $this->accountRepository->new($accountDTO->toArray());

            DB::commit();

            return $worker;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }

    }

    public function update(UpdateWorkerDTO $dto, string $categoryID, string $id): ?object
    {
        throw_if(!auth()->user()->can('workers-update'), new ForbiddenException);

        DB::beginTransaction();
        try {

            $worker = $this->repository->findById($id);
            throw_if(!$worker, new ResourceNotFoundException);

            $account = $this->accountRepository->findByWorker($worker->id);

            if ($dto->photo) {
                $image_path = FunctionHelper::uploadPhoto($dto->photo, 'workers');
                $dto->photo = $image_path;
                if ($worker->photo) {
                    FunctionHelper::deletePhoto($worker->photo);
                }
            }

            $data = $this->repository->update($worker->id, $dto->toArray());

            //editar a categoria da conta do feirante
            $accountDATA = [
                'category_id' => $categoryID,
            ];

            $this->accountRepository->update($account->id, $accountDATA);

            DB::commit();

            return $data;
        } catch (ResourceNotFoundException) {
            throw new ResourceNotFoundException;
        } catch (\Exception $e) {
            DB::rollBack();
            throw new ServerException;
        }

    }

    public function delete(string $id): bool
    {
        throw_if(!auth()->user()->can('workers-delete'), new ForbiddenException);

        $worker = $this->repository->findById($id);
        throw_if(!$worker, new ResourceNotFoundException);

        return $this->repository->delete($worker->id);
    }
}