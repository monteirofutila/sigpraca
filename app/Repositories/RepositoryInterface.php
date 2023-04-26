<?php

namespace App\Repositories;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use Illuminate\Database\Eloquent\Model;
use stdClass;

interface RepositoryInterface
{
    public function getAll();
    public function findById(string $id): stdClass|null;
    public function delete(string $id): void;
    public function new(CreateUserDTO $dto): stdClass;
    public function update(UpdateUserDTO $dto, string $id): stdClass|null;
}
