<?php

namespace App\Services;

use App\Exceptions\ForbiddenException;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\TransactionRepository;
use App\Repositories\WorkerRepository;
use Illuminate\Database\Eloquent\Collection;

class TransactionService
{
    public function __construct(
        protected TransactionRepository $repository, 
        protected WorkerRepository $workerRepository,
    ) {
    }

    public function getAll(): Collection
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        return $this->repository->getAll();
    }
    public function findById(string $id): ?object
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);

        $data = $this->repository->findById($id);
        throw_if(!$data, new ResourceNotFoundException());
        return $data;
    }

    public function getTransactionsByPeriod($startDate, $lastDate): ?object
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        return $this->repository->getTransactionsByPeriod($startDate, $lastDate);
    }

    public function getByWorker(string $workerID): Collection
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        $worker = $this->repository->findById($workerID);
        return $this->repository->getByWorker($worker->id);
    }

}
