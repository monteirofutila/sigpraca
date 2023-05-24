<?php

namespace App\Http\Controllers;

use App\Exceptions\ResourceNotFoundException;
use App\Http\Resources\AccountResource;
use App\Models\Account;
use App\Services\AccountService;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function __construct(
        protected AccountService $service
    ) {
    }

    /**
     * Display the specified resource.
     */
    public function findByWorker(string $workerID)
    {
        $data = $this->service->findByWorker($workerID);
        return new AccountResource($data);
    }

}