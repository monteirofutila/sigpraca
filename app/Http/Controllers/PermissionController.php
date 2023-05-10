<?php

namespace App\Http\Controllers;

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
        $data = $this->permissionService->getAllRoles();
        return new RoleResource($data);
    }

    public function getRoles(string $userID)
    {
        return $this->userService->getRoles($userID);
    }

    public function getPermissions(string $userID)
    {
        return $this->userService->getPermissions($userID);
    }

}