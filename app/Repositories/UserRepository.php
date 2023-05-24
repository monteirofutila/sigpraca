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

    public function getCount()
    {
        return $this->model->count();
    }

    public function getCountByRoles()
    {
        return $this->model->join('model_has_roles', 'users.id', '=', 'model_has_roles.model_id')
            ->join('roles', 'model_has_roles.role_id', '=', 'roles.id')
            ->groupBy('roles.id')
            ->get([
                'roles.name as role_name',
                \DB::raw('COUNT(roles.name) as users_count')
            ]);
    }


}