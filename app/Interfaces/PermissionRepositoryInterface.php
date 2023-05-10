<?php

namespace App\Interfaces;

interface PermissionRepositoryInterface
{
    public function getAllRoles(): ?object;

}