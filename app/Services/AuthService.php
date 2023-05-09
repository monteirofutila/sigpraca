<?php

namespace App\Services;

use App\DTO\Auth\LoginDTO;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected UserRepository $repository,
    ) {
    }

    public function login(LoginDTO $dto): string|bool
    {
        $user = $this->repository->findByUserName($dto->user_name);

        if (!$user || !Hash::check($dto->password, $user->password)) {
            return false;
        }

        return $user->createToken('API Token')->plainTextToken;
    }

    public function me()
    {
        return auth()->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }

}