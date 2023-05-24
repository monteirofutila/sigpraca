<?php

namespace App\Interfaces;

use Illuminate\Support\Collection;

interface RepositoryInterface
{
    public function findById(string $id): ?object;

    public function getAll(): Collection;

    public function new(array $data): object;

    public function update(string $id, array $data): ?object;

    public function delete(string $id): bool;
}