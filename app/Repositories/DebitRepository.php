<?php

namespace App\Repositories;

use App\Interfaces\DebitRepositoryInterface;
use App\Models\Debit;
use Illuminate\Database\Eloquent\Collection;

class DebitRepository extends AbstractRepository implements DebitRepositoryInterface
{
    public function __construct(Debit $debit)
    {
        parent::__construct($debit);
    }

    public function getCount()
    {
        return $this->model->count();
    }

}