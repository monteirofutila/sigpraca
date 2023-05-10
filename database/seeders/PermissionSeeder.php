<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Permission::create(['name' => 'markets-read']);
        Permission::create(['name' => 'markets-update']);
        Permission::create(['name' => 'users-create']);
        Permission::create(['name' => 'users-read']);
        Permission::create(['name' => 'users-update']);
        Permission::create(['name' => 'users-delete']);
        Permission::create(['name' => 'workers-create']);
        Permission::create(['name' => 'workers-read']);
        Permission::create(['name' => 'workers-update']);
        Permission::create(['name' => 'workers-delete']);

        Role::create(['name' => 'admin']);
        Role::create(['name' => 'fiscal']);
        Role::create(['name' => 'caixa']);
    }
}