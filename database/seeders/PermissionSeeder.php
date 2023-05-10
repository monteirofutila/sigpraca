<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
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
        Permission::create(['name' => 'credit']);
        Permission::create(['name' => 'debit']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Administrador']);
        $role1->givePermissionTo('markets-update');
        $role1->givePermissionTo('markets-read');
        $role1->givePermissionTo('workers-create');
        $role1->givePermissionTo('workers-read');
        $role1->givePermissionTo('workers-update');
        $role1->givePermissionTo('workers-delete');
        $role1->givePermissionTo('credit');
        $role1->givePermissionTo('debit');

        $role2 = Role::create(['name' => 'Caixa']);
        $role2->givePermissionTo('credit');
        $role2->givePermissionTo('workers-create');
        $role2->givePermissionTo('workers-read');
        $role2->givePermissionTo('workers-update');
        $role2->givePermissionTo('workers-delete');

        $role3 = Role::create(['name' => 'Fiscal']);
        $role1->givePermissionTo('debit');
    }
}