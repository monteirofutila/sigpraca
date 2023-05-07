<?php

namespace App\Repositories;


use App\Interfaces\CategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends AbstractRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $category)
    {
        parent::__construct($category);
    }

    public function getFirst(): ?object
    {
        return $this->model->first();
    }
}