<?php

namespace App\Http\Controllers;

use App\DTO\Credits\CreditDTO;
use App\DTO\Debits\DebitDTO;
use App\Http\Requests\StoreCreditRequest;
use App\Http\Requests\StoreDebitRequest;
use App\Http\Resources\TransactionResource;
use App\Services\CreditService;
use App\Services\DebitService;
use App\Services\TransactionService;

class TransactionController extends Controller
{
    public function __construct(
        protected CreditService $creditService,
        protected DebitService $debitService,
        protected TransactionService $transactionService
    ) {
    }

    public function index()
    {
        return TransactionResource::collection(
            $this->transactionService->getAll()
        );
    }

    public function getByWorker(string $workerID)
    {
        //
        return TransactionResource::collection(
            $this->transactionService->getByWorker($workerID)
        );
    }

    public function credit(string $workerID)
    {
        //
        $transaction = $this->creditService->add($workerID);
        return new TransactionResource($transaction);
    }

    public function debit(string $workerID)
    {
        //
        $transaction = $this->debitService->add($workerID);
        return new TransactionResource($transaction);
    }

}