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
				"name" => "KIkolo",
				"address" => "Luanda, Cacuaco",
				"description" => "Mercado do KIkolo",
			],

		];
        foreach ($dados as $key => $value){
        	Market::create($value);
        }
    }
}
