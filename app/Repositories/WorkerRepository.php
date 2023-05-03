<?php

namespace App\Repositories;

use App\Interfaces\WorkerRepositoryInterface;
use App\Models\Worker;

class WorkerRepository extends AbstractRepository implements WorkerRepositoryInterface
{
    public function __construct(Worker $worker)
    {
        parent::__construct($worker);
    }

    public function findByEmail(string $email): ?object
    {
        return $this->model->where('email', $email)->first();
    }
}
