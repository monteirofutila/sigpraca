<?php

namespace App\Http\Controllers;

use App\DTO\Auth\LoginDTO;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use App\Services\AuthService;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(protected AuthService $service)
    {
    }

    public function login(LoginRequest $request)
    {
        $dto = LoginDTO::makeFromRequest($request);
        $token = $this->service->login($dto);

        if (!$token) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }

        return response()->json(['token' => $token], 200);
    }

    public function me()
    {
        return new UserResource($this->service->me());
    }

    public function logout(Request $request)
    {
        $this->service->logout($request);
        return response()->json([
            'message' => 'Logout successfully...'
        ], 200);
    }
}