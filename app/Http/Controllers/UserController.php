<?php

namespace App\Http\Controllers;

use App\DTO\Users\UserDTO;
use App\Http\Requests\UserRequest;
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

    public function store(UserRequest $request)
    {
        $dto = UserDTO::makeFromRequest($request);
        $response = $this->service->new($dto);
        return new UserResource($response);
    }

    public function show(string $id)
    {
        $response = $this->service->findById($id);
        return new UserResource($response);
    }

    public function update(string $id, UserRequest $request)
    {
        $dto = UserDTO::makeFromRequest($request);
        $response = $this->service->update($dto, $id);
        return new UserResource($response);
    }

    public function destroy(string $id)
    {
        $data = $this->service->delete($id);

        if (!$data) {
            return response()->json(['message' => 'Usuário não existe...'], 404);
        }

        return response()->json(['message' => 'Usuário eliminado com sucesso...'], 200);
    }
}