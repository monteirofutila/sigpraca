<?php

namespace Database\Seeders;

use App\Models\Market;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MarketSeeder extends Seeder
{
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
            Market::create($value);
        }
    }
}