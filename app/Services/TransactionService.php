<?php

namespace App\Services;

use App\Exceptions\ForbiddenException;
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
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);

        return $this->repository->getAll();
    }

    public function getByWorker(string $workerID): Collection
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        
        return $this->repository->getByWorker($workerID);
    }

}