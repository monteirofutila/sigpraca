<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\UserService;
class UserController extends Controller
{

    public function index(UserService $service)
    {
        return $service->findAll();
    }

    public function store(UserService $service, Request $request)
    {
        return $service->store($request->all());
    }

    public function show(UserService $service,string $id)
    {
        return $service->show($id);
    }

    public function update(UserService $service, string $id,Request $request)
    {
        $data=$service->update($id,$request->all());
        return $data;
    }

    public function destroy(UserService $service, string $id)
    {
        return $service->destroy($id);
    }
}
