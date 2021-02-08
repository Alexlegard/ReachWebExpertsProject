<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
			//Name, email, password, type
			'name' => 'Alex Legard',
			'email' => 'alexlegard3@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
			'type' => 'super'
		]);
    }
}
