<?php

namespace App\Repositories;

use App\Interfaces\PermissionRepositoryInterface;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionRepository implements PermissionRepositoryInterface
{
    public function __construct(
        protected Role $role,
        protected Permission $permission
    ) {
    }

    public function getAllRoles(): ?object
    {
        return $this->role->all();
    }

    public function getAllPermissions(): ?object
    {
        return $this->permission->all();
    }

}