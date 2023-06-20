<?php

namespace App\Services;

use App\DTO\Accounts\AccountDTO;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\AccountRepository;
use App\Repositories\WorkerRepository;

class AccountService
{
    public function __construct(
        protected AccountRepository $repository,
        protected WorkerRepository $workerRepository,
    ) {
    }

    public function findByWorker(string $workerID): ?object
    {
        $worker = $this->workerRepository->findById($workerID);
        throw_if(!$worker, new ResourceNotFoundException);

        $data = $this->repository->findByWorker($worker->id);
        throw_if(!$data, new ResourceNotFoundException);

        return $data;
    }

    public function create(AccountDTO $dto): ?object
    {
        return $this->repository->new($dto->toArray());
    }
}