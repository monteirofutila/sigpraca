<?php

namespace App\Repositories;

use App\Interfaces\AccountRepositoryInterface;
use App\Models\Account;

class AccountRepository extends AbstractRepository implements AccountRepositoryInterface
{
    public function __construct(Account $account)
    {
        parent::__construct($account);
    }

    public function findByWorker(string $workerID): ?object
    {
        return $this->model->with('worker', 'category')->where('worker_id', $workerID)->first();
    }
}