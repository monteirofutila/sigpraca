<?php

namespace Database\Seeders;

use App\Models\Market;
use App\Repositories\MarketRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
    public function __construct(protected MarketRepository $repository)
    {
    }

    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dados = [
            [
                "name" => "SISTEMA DE GERENCIAMENTO DE MERCADOS - SIGM",
                "address" => "SISTEMA DE GERENCIAMENTO DE MERCADOS",
                "description" => "SISTEMA DE GERENCIAMENTO DE MERCADOS",
            ],
        ];

        foreach ($dados as $value) {
            $this->repository->new($value);
        }
    }
}