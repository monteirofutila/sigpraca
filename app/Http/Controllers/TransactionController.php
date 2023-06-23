<?php

namespace App\Http\Controllers;

use App\Http\Requests\TransactionCreditRequest;
use App\Http\Requests\TransactionDebitRequest;
use App\Http\Resources\TransactionResource;
use App\Services\AuthService;
use App\Services\CreditService;
use App\Services\DebitService;
use App\Services\TransactionService;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function __construct(
        protected AuthService $authService,
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

    public function show(string $workerID)
    {
        $response = $this->transactionService->findById($workerID);
        return new TransactionResource($response);
    }

    public function getByWorker(string $workerID)
    {
        //
        return TransactionResource::collection(
            $this->transactionService->getByWorker($workerID)
        );
    }

    public function getTransactionsByPeriod($startDate, $lastDate): ?object
    {
        return TransactionResource::collection(
            $this->transactionService->getTransactionsByPeriod($startDate, $lastDate)
        );
    }

    public function creditbalance(TransactionCreditRequest $request, string $workerID)
    {
        //
        if (!$this->authService->passwordConfirmation($request->password)) {
            return response()->json([
                'message' => 'Desculpe, a senha fornecida não é válida. Por favor, verifique e tente novamente.'
            ], 400);
        }

        $transaction = $this->creditService->add($workerID, $request->amount);
        return new TransactionResource($transaction);
    }

    public function debitBalance(TransactionDebitRequest $request, string $workerID)
    {
        //
        if (!$this->authService->passwordConfirmation($request->password)) {
            return response()->json([
                'message' => 'Desculpe, a senha fornecida não é válida. Por favor, verifique e tente novamente.'
            ], 400);
        }

        $transaction = $this->debitService->add($workerID);
        return new TransactionResource($transaction);
    }

}