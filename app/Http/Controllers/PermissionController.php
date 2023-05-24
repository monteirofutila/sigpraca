<?php

namespace App\Http\Controllers;

use App\Http\Resources\PermissionResource;
use App\Http\Resources\RoleResource;
use App\Services\PermissionService;
use App\Services\UserService;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function __construct(
        protected PermissionService $permissionService,
        protected UserService $userService
    ) {
    }
    public function getAllRoles()
    {
        return RoleResource::collection(
            $this->permissionService->getAllRoles()
        );
    }

    public function getRoles(string $userID)
    {
        return $this->userService->getRoles($userID);
    }

    public function getPermissions(string $userID)
    {
        return PermissionResource::collection(
            $this->userService->getPermissions($userID)
        );
    }

}