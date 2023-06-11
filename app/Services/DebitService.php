<?php

namespace App\Services;

use App\DTO\Debits\DebitDTO;
use App\DTO\Transactions\TransactionDTO;
use App\Exceptions\ForbiddenException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\ServerException;
use App\Exceptions\ValidationException;
use App\Helpers\FunctionHelper;
use App\Repositories\AccountRepository;
use App\Repositories\DebitRepository;
use App\Repositories\TransactionRepository;
use Illuminate\Support\Facades\DB;

class DebitService
{
    public function __construct(
        protected DebitRepository $debitRepository,
        protected TransactionRepository $transactionRepository,
        protected AccountRepository $accountRepository,
    ) {
    }

    public function add(string $workerID): ?object
    {
        throw_if(!auth()->user()->can('transactions-debit'), new ForbiddenException);

        DB::beginTransaction();

        try {

            $account = $this->accountRepository->findByWorker($workerID);
            throw_if(!$account, new ResourceNotFoundException);

            //verifica se ja existe uma operação no dia actual
            $existingTransaction = $this->accountRepository->checkDebitDayByWorker($account->id);
            throw_if($existingTransaction, new ValidationException);

            $previous_balance = $account->balance;
            $description = 'Debit';

            $debitDTO = new DebitDTO(
                account_id: $account->id,
                description: $description,
                value: $account->category->debit
            );

            //verifica se o saldo é suficiente para debitar
            throw_if($account->balance < $debitDTO->value, new ValidationException);

            $debit = $this->debitRepository->new($debitDTO->toArray());
            $account = $this->accountRepository->decrementBalance($account->id, $debit->value);

            $current_balance = $account->balance;
            $userID = auth()->user()->id;

            $transactionDTO = new TransactionDTO(
                code_number: FunctionHelper::generateCodeNumber(),
                user_id: $userID,
                account_id: $account->id,
                description: $description,
                value: $debitDTO->value,
                previous_balance: $previous_balance,
                current_balance: $current_balance,
                model_id: $debit->id,
                model_type: $debit::class, //model_type
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