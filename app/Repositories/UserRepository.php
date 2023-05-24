<?php

namespace App\Repositories;


use App\Interfaces\UserRepositoryInterface;
use App\Models\User;

class UserRepository extends AbstractRepository implements UserRepositoryInterface
{
    public function __construct(User $user)
    {
        parent::__construct($user);
    }

    public function findByEmail(string $email): ?object
    {
        return $this->model->where('email', $email)->first();
    }

    public function findByUserName(string $userName): ?object
    {
        return $this->model->where('user_name', $userName)->first();
    }

    public function getRoles(string $userID): ?object
    {
        $model = $this->model->find($userID);

        if ($model) {
            return $model->getRoleNames();
        }

        return null;
    }

    public function getPermissions(string $userID): ?object
    {

        $model = $this->model->find($userID);

        if ($model) {
            return $model->getAllPermissions();
        }

        return null;
    }


}