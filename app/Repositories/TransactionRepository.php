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

    public function new(array $data): object
    {
        return $this->model->create($data)->load('account.worker', 'user');
    }

    public function getAll(): Collection
    {
        return $this->model->with('account.worker', 'user')->get();
    }

    public function getByWorker(string $workerID): Collection
    {
        return $this->model->with('account.worker', 'user')->whereHas('account', function ($query) use ($workerID) {
            $query->whereHas('worker', function ($query2) use ($workerID) {
                $query2->id = $workerID;
            });
        })->get();
    }

    public function getCount()
    {
        return $this->model->count();
    }

}