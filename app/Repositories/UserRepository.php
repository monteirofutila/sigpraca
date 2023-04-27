<?php

namespace App\Repositories;
use App\Models\User;
class UserRepository
{
	private $user;

	public function __construct(User $user)
	{
		$this->user = $user;
	}

	public function findAll()
	{
		return $this->user->all();
	}
    public function store(array $data)
	{
		return $this->user->create($data);
	}
    public function show(string $id){
        return $this->user->find($id);
    }
    public function update(string $id,array $data){
        $user =$this->show($id);
        $user->update($data);
        return $this->show($id);
    }
    public function delete(string $id){
        $user =$this->user->find($id);
        return $this->delete();
    }
}
