<?php

namespace App\Repositories;

use App\Interfaces\CreditRepositoryInterface;
use App\Models\Credit;
use Carbon\Carbon;

class CreditRepository extends AbstractRepository implements CreditRepositoryInterface
{
    public function __construct(Credit $credit)
    {
        parent::__construct($credit);
    }

    public function getCount()
    {
        return $this->model->count();
    }

    public function getTotalCreditAmountByPeriod($startDate, $lastDate): float
    {
        $startDate = Carbon::parse($startDate)->startOfDay();
        $lastDate = Carbon::parse($lastDate)->endOfDay();
        return $this->model->whereBetween('created_at', [$startDate, $lastDate])
            ->sum('amount');
    }

}