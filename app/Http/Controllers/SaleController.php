<?php

namespace App\Http\Controllers;

use App\Services\CreditService;

class SaleController extends Controller
{
    public function __construct(
        protected CreditService $creditService,
    ) {
    }

    public function saleByPeriod($startDate, $lastDate)
    {
        $amount = $this->creditService->getTotalCreditAmountByPeriod($startDate, $lastDate);

        return [
            'data' => [
                'start_date' => $startDate,
                'last_date' => $lastDate,
                'amount' => $amount,
            ],
        ];
    }

}