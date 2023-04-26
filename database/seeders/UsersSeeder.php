<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $dados = [
			[
                'name' => 'Root',
                'role' => '1',
                'email' => 'root@gmail.com',
                'password' => 'password'
            ],
		];
        foreach ($dados as $key => $value){
        	User::create($value);
        }
    }
}
