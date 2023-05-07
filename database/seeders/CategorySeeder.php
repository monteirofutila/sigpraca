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
				"name" => "VENDEDOR",
				"description" => "VENDEDOR",
				"credit" => "1000",
				"debit" => "100"
			],
		];

		foreach ($dados as $value) {
			$this->repository->new($value);
		}
	}
}