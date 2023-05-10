<?php

namespace App\Interfaces;

interface AccountRepositoryInterface extends RepositoryInterface
{
    public function findByWorker(string $workerID): ?object;
}