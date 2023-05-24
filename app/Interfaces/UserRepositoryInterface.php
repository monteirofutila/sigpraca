<?php

namespace App\Interfaces;

interface UserRepositoryInterface extends RepositoryInterface
{
    public function findByEmail(string $email): ?object;
    public function getRoles(string $userID): ?object;
    public function getPermissions(string $userID): ?object;
}