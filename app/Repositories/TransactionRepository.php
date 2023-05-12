<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Illuminate\Database\Eloquent\Collection;

class TransactionRepository extends AbstractRepository implements TransactionRepositoryInterface
{
    public function __construct(Transaction $transaction)
    {
        parent::__construct($transaction);
    }

    public function getByWorker(string $workerID): Collection
    {
        return $this->model->where('worker_id', $workerID)->get();
    }

}