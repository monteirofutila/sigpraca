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

    public function getByWorker(string $workerID)
    {
        //
        return TransactionResource::collection(
            $this->transactionService->getByWorker($workerID)
        );
    }

    public function creditbalance(TransactionCreditRequest $request, string $workerID)
    {
        //
        if (!$this->authService->passwordConfirmation($request->password)) {
            return response()->json([
                'message' => 'Credentials do not match'
            ], 400);
        }

        $transaction = $this->creditService->add($workerID, $request->value);
        return new TransactionResource($transaction);
    }

    public function debitBalance(TransactionDebitRequest $request, string $workerID)
    {
        //
        if (!$this->authService->passwordConfirmation($request->password)) {
            return response()->json([
                'message' => 'Credentials do not match'
            ], 400);
        }

        $transaction = $this->debitService->add($workerID);
        return new TransactionResource($transaction);
    }

}