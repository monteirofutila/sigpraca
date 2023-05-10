<?php

namespace App\Services;

use App\DTO\Accounts\AccountDTO;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\AccountRepository;

class AccountService
{
    public function __construct(
        protected AccountRepository $repository,
    ) {
    }

    public function findByWorker(string $workerID): ?object
    {
        $data = $this->repository->findByWorker($workerID);
        throw_if(!$data, new ResourceNotFoundException);
        return $data;
    }

    public function create(AccountDTO $dto): ?object
    {
        return $this->repository->new($dto->toArray());
    }
}