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
        $data = $this->service->login($dto);
        
        if (!$data) {
            return response()->json([
                'message' => 'The provided credentials do not match our records.'
            ], 401);
        }

        return response()->json([
            'token' => $data['token'],
            'user' => new UserResource($data['user']),
        ], 200);
    }

    public function me(Request $request)
    {
        return new UserResource($this->service->me($request));
    }

    public function logout(Request $request)
    {
        $this->service->logout($request);
        return response()->json([
            'message' => 'Logout successfully...'
        ], 200);
    }
}
