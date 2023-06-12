<?php

namespace Database\Seeders;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
	public function __construct(protected CategoryRepository $repository)
	{
	}

	/**
	 * Run the database seeds.
	 */
	public function run()
	{
		$dados = [
			[
				"name" => "BANCADA",
				"description" => "FEIRANTE",
				"payment_period" => "day",
				"debit_amount" => 100
			],
			[
				"name" => "AMBULANTE",
				"description" => "FEIRANTE",
				"payment_period" => "day",
				"debit_amount" => 100
			],
			[
				"name" => "CONTENTORES",
				"description" => "FEIRANTE",
				"payment_period" => "day",
				"debit_amount" => 100
			],
			[
				"name" => "ARMAZÉM",
				"description" => "FEIRANTE",
				"payment_period" => "day",
				"debit_amount" => 100
			],
			[
				"name" => "TAXISTA",
				"description" => "FEIRANTE",
				"payment_period" => "day",
				"debit_amount" => 100
			],
		];

		foreach ($dados as $value) {
			$this->repository->new($value);
		}
	}
}