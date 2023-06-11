<?php

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use Illuminate\Database\Eloquent\Collection;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface
{
    public function __construct(Account $account)
    {
        parent::__construct($account);
    }

    public function findByWorker(string $workerID): ?object
    {
        return $this->model->with('worker', 'category', 'transactions')->where('worker_id', $workerID)->first();
    }

    public function incrementBalance(string $accountID, float $value): ?object
    {
        $model = $this->model->find($accountID);
        $model->increment('balance', $value);
        return $model;
    }

    public function decrementBalance(string $accountID, float $value): ?object
    {
        $model = $this->model->find($accountID);
        $model->decrement('balance', $value);
        return $model;
    }

    public function checkDebitDayByWorker(string $accountID): bool
    {
        // Obter a data atual no formato Y-m-d
        $currentDate = date('Y-m-d');
        $debit = $this->model->with('debits')->find($accountID)->debits()->whereDate('created_at', $currentDate)
            ->first();

        if ($debit) {
            return true;
        } else {
            return false;
        }
    }

}