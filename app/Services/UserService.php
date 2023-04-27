<?php

namespace App\Services;
use App\Repositories\UserRepository;
class UserService
{
    private $repository;

    public function __construct(UserRepository $repository)
	{
		$this->repository = $repository;
	}
    public function findAll()
    {
        $data = $this->repository->findAll();
        return response()->json($data);
    }

    public function store(array $data)
    {
        $data= $this->repository->store($data);
        if (!$data) {
            return response()->json([
                'message' => 'Nenhum registro de usuário encontrado'
            ], 404);
        }
        return response()->json($data);
    }

    public function show(string $id)
    {
        $user =$this->repository->show($id);
        $data=$user;
        if (!$data) {
            return response()->json([
                'message' => 'Nenhum registro de usuário encontrado'
            ], 404);
        }
        return response()->json($data);

    }

    public function update(string $id,array $data)
    {
        $data=$this->repository->update($id,$data);
        if (!$data) {
            return response()->json([
                'message' => 'Nenhum registro de usuário encontrado'
            ], 404);
        }
        return response()->json($data);
    }

    public function destroy(string $id)
    {
        $user =$this->repository->show($id);
        if (!$user) {
            return response()->json([
                'message' => 'Nenhum registro de usuário encontrado'
            ], 404);
        }
        $user->delete();
        return response()->json(['data' => ['msg' => 'User eliminado com sucesso']]);
    }
}
