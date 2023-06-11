<?php

namespace App\Services;

use App\DTO\Credits\CreditDTO;
use App\DTO\Transactions\TransactionDTO;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ServerException;
use App\Helpers\FunctionHelper;
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

    public function add(string $workerID, float $creditValue): ?object
    {
        throw_if(!auth()->user()->can('transactions-credit'), new ForbiddenException);

        DB::beginTransaction();

        try {

            $account = $this->accountRepository->findByWorker($workerID);
            throw_if(!$account, new ResourceNotFoundException);

            $previous_balance = $account->balance;
            $description = 'Credit';

            $creditDTO = new CreditDTO(
                account_id: $account->id,
                description: $description,
                value: $creditValue
            );

            $credit = $this->creditRepository->new($creditDTO->toArray());
            $account = $this->accountRepository->incrementBalance($account->id, $credit->value);

            $current_balance = $account->balance;
            $userID = auth()->user()->id;

            $transactionDTO = new TransactionDTO(
                code_number: FunctionHelper::generateCodeNumber(),
                user_id: $userID,
                account_id: $account->id,
                description: $description,
                value: $creditDTO->value,
                previous_balance: $previous_balance,
                current_balance: $current_balance,
                model_id: $credit->id,
                model_type: $credit::class, //model_type
            );

            $transaction = $this->transactionRepository->new($transactionDTO->toArray());

            DB::commit();

            return $transaction;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }
}