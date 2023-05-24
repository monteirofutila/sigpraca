<?php

namespace App\Interfaces;

interface WorkerRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?object;
}