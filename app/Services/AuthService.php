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

    public function login(LoginDTO $dto): array|bool
    {
        $user = $this->repository->findByUserName($dto->user_name);
        
        if (!$user || !Hash::check($dto->password, $user->password)) {
            return false;
        }

        $data = [
           'token' => $user->createToken('API Token')->plainTextToken,
           'user' => $user,
        ];
        
        return $data;
    }

    public function me(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
    }

}