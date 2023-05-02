<?php

namespace App\Http\Controllers;

use App\DTO\Workers\CreateWorkerDTO;
use App\DTO\Workers\UpdateWorkerDTO;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Worker;
use App\Services\WorkerService;

class WorkerController extends Controller
{
    public function __construct(
        protected WorkerService $service
    ){
    }
    public function index()
    {
        $response= $this->service->getAll();
        return response()->json($response);
    }

    public function store(StoreWorkerRequest $request)
    {
        $dto = CreateWorkerDTO::makeFromRequest($request);
        $response = $this->service->new($dto);
        return response()->json($response);
    }

    public function show(string $id)
    {
        $response= $this->service->findById($id);
        return response()->json($response);
    }

    public function update(string $id, StoreWorkerRequest $request)
    {
        $dto = UpdateUserDTO::makeFromRequest($request);
        $response= $this->service->update($dto, $id);
        return response()->json($response);
    }

    public function destroy(string $id)
    {
        $response= $this->service->delete($id);
        return response()->json($response);
    }
}
