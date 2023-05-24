<?php

namespace App\Interfaces;

interface AccountRepositoryInterface extends RepositoryInterface
{
    public function findByWorker(string $workerID): ?object;
    public function incrementBalance(string $accountID, float $value): ?object;
    public function decrementBalance(string $accountID, float $value): ?object;
}