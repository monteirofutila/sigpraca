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
                "name" => "KIKOLO",
                "address" => "Angola, Luanda, Cacuaco",
                "description" => "Mercado do Kikolo",
            ],
        ];

        foreach ($dados as $value) {
            $this->repository->new($value);
        }
    }
}