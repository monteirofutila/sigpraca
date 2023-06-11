<?php

namespace App\Services;

use App\DTO\Auth\LoginDTO;
use App\Repositories\UserRepository;
use Illuminate\Http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function __construct(
        protected UserRepository $repository,
    ) {
    }

    public function login(LoginDTO $dto): array|bool|object
    {
        $user = $this->repository->findByUserName($dto->user_name);
        
        if (!$user || !Hash::check($dto->password, $user->password)) {
            
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        
        }

        $data = [
           'token' => $user->createToken('API Token')->plainTextToken,
           'user' => $user,
        ];
        
        return $data;
    }

    public function passwordConfirmation(string $password): bool
    {
        $user = auth()->user();
        
        if (!$user || !Hash::check($password, $user->password)) {
            return false;
        }

        return true;
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