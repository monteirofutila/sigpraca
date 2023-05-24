<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Repositories\TransactionRepository;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    public function __construct(
        protected TransactionRepository $repository,
    ) {
    }

    public function getAll(): Collection
    {
        return $this->repository->getAll();
    }

    public function getByWorker(string $workerID): Collection
    {
        return $this->repository->getByWorker($workerID);
    }

}