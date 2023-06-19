<?php

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;
use Illuminate\Support\Carbon;

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

    public function checkDebitPeriodByAccount(string $accountID): bool
    {
        $account = $this->model->with('debits', 'category')->find($accountID);
        $paymentPeriod = $account->category->payment_period;
        $firstDate = Carbon::now()->startOf($paymentPeriod);
        $lastDate = Carbon::now()->endOf($paymentPeriod);
        return $account->debits()->whereBetween('created_at', [$firstDate, $lastDate])->exists();
    }

}
