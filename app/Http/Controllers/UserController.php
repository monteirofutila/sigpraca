<?php

namespace App\Http\Controllers;

use App\DTO\Users\CreateUserDTO;
use App\DTO\Users\UpdateUserDTO;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function __construct(
        protected UserService $service
    ){
    }

    public function index()
    {
        $response= $this->service->getAll();
        return response()->json($response);
    }

    public function store(StoreUserRequest $request)
    {
        $dto = CreateUserDTO::makeFromRequest($request);
        $response = $this->service->new($dto);
        return response()->json($response);
    }

    public function show(string $id)
    {
        $response= $this->service->findById($id);
        return response()->json($response);
    }

    public function update(string $id, UpdateUserRequest $request)
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


