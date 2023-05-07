<?php

namespace App\Http\Controllers;

use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Http\Resources\WorkerResource;
use App\Services\WorkerService;

class WorkerController extends Controller
{
    public function __construct(
        protected WorkerService $service
    ) {
    }
    public function index()
    {
        $response = $this->service->getAll();
        return WorkerResource::collection($response);
    }

    public function store(StoreWorkerRequest $request)
    {
        $dto = CreateWorkerDTO::makeFromRequest($request);
        $response = $this->service->new($dto);
        return new WorkerResource($response);
    }

    public function show(string $id)
    {
        $response = $this->service->findById($id);
        return new WorkerResource($response);
    }

    public function update(string $id, UpdateWorkerRequest $request)
    {
        $dto = UpdateWorkerDTO::makeFromRequest($request);
        $response = $this->service->update($dto, $id);
        return new WorkerResource($response);
    }

    public function destroy(string $id)
    {
        $data = $this->service->delete($id);

        if (!$data) {
            return response()->json(['message' => 'Trabalhador não existe...'], 404);
        }

        return response()->json(['message' => 'Trabalhador eliminado com sucesso...'], 204);
    }
}