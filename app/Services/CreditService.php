<?php

namespace App\Services;

use App\DTO\Credits\CreditDTO;
use App\DTO\Transactions\TransactionDTO;
use App\Exceptions\ResourceNotFoundException;
use App\Repositories\AccountRepository;
use App\Repositories\CreditRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\DB;

class CreditService
{
    public function __construct(
        protected CreditRepository $creditRepository,
        protected TransactionRepository $transactionRepository,
        protected AccountRepository $accountRepository,
    ) {
    }

    public function add(string $workerID): ?object
    {
        DB::beginTransaction();

        try {

            $account = $this->accountRepository->findByWorker($workerID);
            throw_if(!$account, new ResourceNotFoundException);

            $previous_balance = $account->balance;
            $description = 'Credit';

            $creditDTO = new CreditDTO(
                $account->id,
                $description,
                $account->category->credit
            );

            $credit = $this->creditRepository->new($creditDTO->toArray());
            $account = $this->accountRepository->incrementBalance($account->id, $credit->value);

            $current_balance = $account->balance;
            $userID = auth()->user()->id;

            $transactionDTO = new TransactionDTO(
                $userID,
                $description,
                $creditDTO->value,
                $previous_balance,
                $current_balance,
                $credit->id,
                get_class($credit), //model_type
            );

            $transaction = $this->transactionRepository->new($transactionDTO->toArray());

            DB::commit();

            return $transaction;
        } catch (\Exception $e) {
            DB::rollBack();
            throw $e;
        }
    }
}