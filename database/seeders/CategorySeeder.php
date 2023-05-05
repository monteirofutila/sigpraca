<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $dados = [
			[
				"name" => "CAIXA",
				"description" => "teste",
				"credit" => "1000",
                "debit" => "10",
			],
			[
                "name" => "CAIXA",
				"description" => "teste",
				"credit" => "1000",
                "debit" => "10",
			],
			[
                "name" => "CAIXA",
				"description" => "teste",
				"credit" => "1000",
                "debit" => "10",
			],


		];
        foreach ($dados as $key => $value){
        	Category::create($value);
        }
    }
}
