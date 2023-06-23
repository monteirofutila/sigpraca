<?php

namespace App\Http\Controllers;

use App\DTO\Categories\CategoryDTO;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    public function __construct(
        protected CategoryService $service,
    ) {
    }
    public function index()
    {
        $response = $this->service->getAll();
        return CategoryResource::collection($response);
    }

    public function store(CategoryRequest $request)
    {
        $dto = CategoryDTO::makeFromRequest($request);
        $worker = $this->service->new($dto);
        return new CategoryResource($worker);
    }

    public function show(string $categoryID)
    {
        $response = $this->service->findById($categoryID);
        return new CategoryResource($response);
    }

    public function update(string $categoryID, CategoryRequest $request)
    {
        $dto = CategoryDTO::makeFromRequest($request);
        $response = $this->service->update($dto, $categoryID);
        return new CategoryResource($response);
    }

    public function destroy(string $workerID)
    {
        $this->service->delete($workerID);
        return response()->json([
            'message' => 'O recurso selecionado foi removido com sucesso.'
        ], 200);
    }
}