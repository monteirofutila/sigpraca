<?php

namespace App\Repositories;

use App\Interfaces\TransactionRepositoryInterface;
use App\Models\Transaction;
use Carbon\Carbon;
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

    public function getTransactionsByPeriod($startDate, $lastDate): ?object
    {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $lastDate = Carbon::parse($lastDate)->endOfDay();
        return $this->model->with('account.worker', 'user')->whereBetween('created_at', [$startDate, $lastDate])
            ->get();
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