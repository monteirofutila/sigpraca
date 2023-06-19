<?php

namespace App\Repositories;

use App\Interfaces\WorkerRepositoryInterface;
use App\Models\Worker;
use Ramsey\Uuid\Uuid;

class WorkerRepository extends AbstractRepository implements WorkerRepositoryInterface
{
    public function __construct(Worker $worker)
    {
        parent::__construct($worker);
    }

    public function findById(string $id): ?object
    {
        $field = Uuid::isValid($id) ? 'id' : 'code_number';
        return $this->model->where($field, $id)->first();
    }

    public function findByEmail(string $email): ?object
    {
        return $this->model->where('email', $email)->first();
    }
    public function getCount()
    {
        return $this->model->count();
    }
}
