<?php

namespace App\Interfaces;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?object;
}