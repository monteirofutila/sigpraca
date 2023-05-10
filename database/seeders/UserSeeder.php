<?php

namespace Database\Seeders;

use App\Repositories\UserRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function __construct(protected UserRepository $repository)
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $user = $this->repository->new([
            'name' => 'Administrador',
            'user_name' => 'admin',
            'email' => 'admin@app.com',
            'password' => Hash::make('password'),
            'photo' => fake()->imageUrl(),
            'gender' => 'M',
        ]);
        $user->assignRole('Administrador');

        $user = $this->repository->new([
            'name' => 'Operador de caixa',
            'user_name' => 'caixa',
            'email' => 'caixa@app.com',
            'password' => Hash::make('password'),
            'photo' => fake()->imageUrl(),
            'gender' => 'M',
        ]);
        $user->assignRole('Caixa');

        $user = $this->repository->new([
            'name' => 'Fiscal',
            'user_name' => 'fiscal',
            'email' => 'fiscal@app.com',
            'password' => Hash::make('password'),
            'photo' => fake()->imageUrl(),
            'address_street' => fake()->streetAddress(),
            'date_birth' => '2020-03-02',
            'gender' => 'M',
        ]);
        $user->assignRole('Fiscal');

    }
}