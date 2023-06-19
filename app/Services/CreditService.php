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
use App\Repositories\WorkerRepository;
use Illuminate\Support\Facades\DB;

class CreditService
{
    public function __construct(
        protected CreditRepository $creditRepository,
        protected TransactionRepository $transactionRepository,
        protected AccountRepository $accountRepository,
        protected WorkerRepository $workerRepository,
    ) {
    }

    public function add(string $workerID, float $creditValue): ?object
    {
        throw_if(!auth()->user()->can('transactions-credit'), new ForbiddenException);

        DB::beginTransaction();

        try {

            $worker = $this->workerRepository->findById($workerID);
            $account = $this->accountRepository->findByWorker($worker->id);
            throw_if(!$account, new ResourceNotFoundException);

            $previous_balance = $account->balance;
            $description = 'Crédito';

            $creditDTO = new CreditDTO(
                account_id: $account->id,
                description: $description,
                amount: $creditValue
            );

            $credit = $this->creditRepository->new($creditDTO->toArray());
            $account = $this->accountRepository->incrementBalance($account->id, $credit->amount);

            $current_balance = $account->balance;
            $userID = auth()->user()->id;

            $transactionDTO = new TransactionDTO(
                code_number: FunctionHelper::generateCodeNumber(),
                user_id: $userID,
                account_id: $account->id,
                description: $description,
                amount: $creditDTO->amount,
                previous_balance: $previous_balance,
                current_balance: $current_balance,
                model_id: $credit->id,
                model_type: $credit::class, //model_type
            );

            $transaction = $this->transactionRepository->new($transactionDTO->toArray());

            DB::commit();

            return $transaction;
        } catch (ResourceNotFoundException) {
            throw new ResourceNotFoundException;
        } catch (\Exception) {
            DB::rollBack();
            throw new ServerException;
        }
    }

    public function getTotalCreditAmountByPeriod($startDate, $lastDate): float
    {
        throw_if(!auth()->user()->can('transactions-read'), new ForbiddenException);
        return $this->creditRepository->getTotalCreditAmountByPeriod($startDate, $lastDate);
    }
}
