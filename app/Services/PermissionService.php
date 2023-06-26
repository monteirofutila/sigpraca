<?php

namespace App\Services;

use App\Repositories\PermissionRepository;

class PermissionService
{
    public function __construct(
        protected PermissionRepository $repository,
    ) {
    }

    public function getAllRoles(): ?object
    {
        return $this->repository->getAllRoles();
    }

    public function getAllPermissions(): ?object
    {
        return $this->repository->getAllPermissions();
    }

}