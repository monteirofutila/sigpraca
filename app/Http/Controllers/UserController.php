<?php

namespace App\Http\Controllers;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Services\UserService;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ) {
    }

    public function index()
    {
        $response = $this->service->getAll();
        return UserResource::collection($response);
    }

    public function store(StoreUserRequest $request)
    {
        $dto = CreateUserDTO::makeFromRequest($request);
        $response = $this->service->new($dto);
        return new UserResource($response);
    }

    public function show(string $id)
    {
        $response = $this->service->findById($id);
        return new UserResource($response);
    }

    public function update(string $userID, UpdateUserRequest $request)
    {
        $dto = UpdateUserDTO::makeFromRequest($request);
        $response = $this->service->update($dto, $userID);
        return new UserResource($response);
    }

    public function destroy(string $id)
    {
        $this->service->delete($id);
        return response()->json([
            'message' => 'Usuário eliminado com sucesso...'
        ], 200);
    }

}