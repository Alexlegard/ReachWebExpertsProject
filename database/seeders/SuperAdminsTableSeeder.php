<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\SuperAdmin;

class SuperAdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SuperAdmin::create([
			//Name, email, password, type
			'name' => 'Melissa Legard',
			'email' => 'melissalegard3@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
    }
}
