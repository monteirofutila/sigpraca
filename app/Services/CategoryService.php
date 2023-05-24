<?php

namespace App\Services;

use App\Exceptions\ResourceNotFoundException;
use App\Repositories\CategoryRepository;

class CategoryService
{
    public function __construct(
        protected CategoryRepository $repository,
    ) {
    }

    public function getFirst(): ?object
    {
        return $this->repository->getFirst();
    }
}