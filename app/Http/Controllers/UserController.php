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
        return $this->service->getAll();
    }

    public function store(StoreUserRequest $request)
    {   
        $dto = CreateUserDTO::makeFromRequest($request); 
        return $this->service->new($dto);
    }

    public function show(string $id)
    {
        return $this->service->findById($id);
    }

    public function update(string $id, UpdateUserRequest $request)
    {
        $dto = UpdateUserDTO::makeFromRequest($request); 
        return $this->service->update($dto, $id);
    }

    public function destroy(string $id)
    {
        return $this->service->delete($id);
    }
}


