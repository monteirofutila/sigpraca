<?php

namespace App\Interfaces;

use Illuminate\Database\Eloquent\Collection;

interface TransactionRepositoryInterface extends RepositoryInterface
{
    public function getByWorker(string $workerID): Collection;
}