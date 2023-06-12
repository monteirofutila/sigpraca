<?php

namespace App\Services;

use App\Exceptions\ForbiddenException;
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
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        return $this->repository->getAll();
    }

    public function getTransactionsByPeriod($startDate, $lastDate): ?object
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        return $this->repository->getTransactionsByPeriod($startDate, $lastDate);
    }

    public function getByWorker(string $workerID): Collection
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        return $this->repository->getByWorker($workerID);
    }

}