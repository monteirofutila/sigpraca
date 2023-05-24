<?php

namespace App\Services;

use App\Repositories\CreditRepository;
use App\Repositories\DebitRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;
use App\Repositories\WorkerRepository;

class StatistService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected TransactionRepository $transactioRepository,
        protected CreditRepository $creditRepository,
        protected DebitRepository $debitRepository,
        protected WorkerRepository $workerRepository,
    ) {
    }

    public function stast(): ?object
    {

        $response['users_count'] = $this->userRepository->getCount();
        $response['workers_count'] = $this->workerRepository->getCount();
        $response['credits_ count'] = $this->creditRepository->getCount();
        $response['debits_count'] = $this->debitRepository->getCount();
        $response['transactions_count'] = $this->transactioRepository->getCount();

        return (object) $response;
    }

}