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
        $dados = [
            [
                'name' => 'Administrador',
                'user_name' => 'admin',
                'email' => 'admin@app.com',
                'password' => Hash::make('password'),
                'photo' => fake()->imageUrl(),
                'phone_mobile' => fake()->phoneNumber(),
                'phone_other' => null,
                'address_country' => fake()->country(),
                'address_state' => null,
                'address_city' => null,
                'address_street' => fake()->streetAddress(),
                'date_birth' => '2020-03-02',
                'gender' => 'M',
                'bi' => '12345678901234',
            ],
        ];

        foreach ($dados as $value) {
            $this->repository->new($value);
        }
    }
}