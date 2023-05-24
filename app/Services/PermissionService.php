<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
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

}