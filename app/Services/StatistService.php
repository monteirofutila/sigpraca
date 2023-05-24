<?php

namespace App\Services;

use App\Repositories\CreditRepository;
use App\Repositories\DebitRepository;
use App\Repositories\TransactionRepository;
use App\Repositories\UserRepository;

class StatistService
{
    public function __construct(
        protected UserRepository $userRepository,
        protected TransactionRepository $transactioRepository,
        protected CreditRepository $creditRepository,
        protected DebitRepository $debitRepository,
    ) {
    }

    public function stast(): ?object
    {

        $response['users'] = $this->userRepository->getCount();
        $data = $this->userRepository->getCountByRoles();

        foreach ($data as $value) { # code...
            $response[$value->role_name] = $value->users_count;
        }

        $response['credits'] = $this->creditRepository->getCount();
        $response['debits'] = $this->debitRepository->getCount();
        $response['transactions'] = $this->transactioRepository->getCount();

        return (object) $response;
    }

}