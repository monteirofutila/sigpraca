<?php

namespace App\Http\Controllers;

use App\DTO\Accounts\AccountDTO;
use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Services\AccountService;
use App\Services\CategoryService;
use App\Services\WorkerService;

class WorkerController extends Controller
{
    public function __construct(
        protected WorkerService $workerService,
        protected AccountService $accountService,
        protected CategoryService $categoryService
    ) {
    }
    public function index()
    {
        $response = $this->workerService->getAll();
        return WorkerResource::collection($response);
    }

    public function store(StoreWorkerRequest $request)
    {
        $workerDTO = CreateWorkerDTO::makeFromRequest($request);
        $worker = $this->workerService->new($workerDTO);
        return new WorkerResource($worker);
    }

    public function show(string $workerID)
    {
        $response = $this->workerService->findById($workerID);
        return new WorkerResource($response);
    }

    public function update(string $workerID, UpdateWorkerRequest $request)
    {
        $dto = UpdateWorkerDTO::makeFromRequest($request);
        $response = $this->workerService->update($dto, $workerID);
        return new WorkerResource($response);
    }

    public function destroy(string $workerID)
    {
        $this->workerService->delete($workerID);
        return response()->json([
            'message' => 'Trabalhador eliminado com sucesso...'
        ], 200);
    }
}