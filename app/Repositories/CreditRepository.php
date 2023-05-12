<?php

namespace App\Repositories;

use App\Interfaces\CreditRepositoryInterface;
use App\Models\Credit;

class CreditRepository extends AbstractRepository implements CreditRepositoryInterface
{
    public function __construct(Credit $credit)
    {
        parent::__construct($credit);
    }

}