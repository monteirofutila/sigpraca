<?php

namespace App\Repositories;

use App\Interfaces\DebitRepositoryInterface;
use App\Models\Debit;

class DebitRepository extends AbstractRepository implements DebitRepositoryInterface
{
    public function __construct(Debit $debit)
    {
        parent::__construct($debit);
    }

}