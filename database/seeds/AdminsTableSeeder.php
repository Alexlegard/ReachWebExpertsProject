<?php

use Illuminate\Database\Seeder;
use App\Admin;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::create([
			//Name, email, password, type
			'name'     => 'Evan Legard',
			'email'    => 'evanlegard3@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		Admin::create([
			'name'     => 'Eric Balian',
			'email'    => 'ericbalian@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		/*
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 2',
			'email' => 'admin2@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 3',
			'email' => 'admin3@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 4',
			'email' => 'admin4@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 5',
			'email' => 'admin5@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 6',
			'email' => 'admin6@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 7',
			'email' => 'admin7@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 8',
			'email' => 'admin8@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 9',
			'email' => 'admin9@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 10',
			'email' => 'admin10@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 11',
			'email' => 'admin11@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 12',
			'email' => 'admin12@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 13',
			'email' => 'admin13@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 14',
			'email' => 'admin14@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 15',
			'email' => 'admin15@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 16',
			'email' => 'admin16@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 17',
			'email' => 'admin17@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 18',
			'email' => 'admin18@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 19',
			'email' => 'admin19@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);
		
		Admin::create([
			//Name, email, password, type
			'name' => 'Admin 20',
			'email' => 'admin20@gmail.com',
			'password' => '$2y$10$.owxR/OjLUX/07HTmYXsne7yl0N6K7AN5ezbCyrZiwCpvgezU4EDO',
		]);*/
    }
}
