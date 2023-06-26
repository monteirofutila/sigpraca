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
        Permission::create(['name' => 'categories-create']);
        Permission::create(['name' => 'categories-read']);
        Permission::create(['name' => 'categories-update']);
        Permission::create(['name' => 'categories-delete']);
        Permission::create(['name' => 'markets-read']);
        Permission::create(['name' => 'markets-update']);
        Permission::create(['name' => 'users-create']);
        Permission::create(['name' => 'users-read']);
        Permission::create(['name' => 'users-update']);
        Permission::create(['name' => 'users-delete']);
        Permission::create(['name' => 'transactions-credit']);
        Permission::create(['name' => 'transactions-debit']);
        Permission::create(['name' => 'transactions-read']);
        Permission::create(['name' => 'transactions-update']);
        Permission::create(['name' => 'transactions-delete']);
        Permission::create(['name' => 'workers-create']);
        Permission::create(['name' => 'workers-read']);
        Permission::create(['name' => 'workers-update']);
        Permission::create(['name' => 'workers-delete']);

        // create roles and assign existing permissions
        $role1 = Role::create(['name' => 'Administrador']);
        $role1->givePermissionTo('categories-create');
        $role1->givePermissionTo('categories-read');
        $role1->givePermissionTo('categories-update');
        $role1->givePermissionTo('categories-delete');
        $role1->givePermissionTo('markets-update');
        $role1->givePermissionTo('markets-read');
        $role1->givePermissionTo('transactions-credit');
        $role1->givePermissionTo('transactions-debit');
        $role1->givePermissionTo('transactions-read');
        $role1->givePermissionTo('transactions-update');
        $role1->givePermissionTo('transactions-delete');
        $role1->givePermissionTo('users-create');
        $role1->givePermissionTo('users-read');
        $role1->givePermissionTo('users-update');
        $role1->givePermissionTo('users-delete');
        $role1->givePermissionTo('workers-create');
        $role1->givePermissionTo('workers-read');
        $role1->givePermissionTo('workers-update');
        $role1->givePermissionTo('workers-delete');


        $role2 = Role::create(['name' => 'Caixa']);
        $role2->givePermissionTo('categories-read');
        $role2->givePermissionTo('transactions-credit');
        $role2->givePermissionTo('transactions-read');
        $role2->givePermissionTo('workers-create');
        $role2->givePermissionTo('workers-read');
        $role2->givePermissionTo('workers-update');

        $role3 = Role::create(['name' => 'Fiscal']);
        $role3->givePermissionTo('transactions-debit');
    }
}