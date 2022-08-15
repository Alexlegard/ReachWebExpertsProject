<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\User;
use Carbon\Carbon;

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
			'password' => '$2y$10$qhHezfZ0Y7EmobU9YeMtiO1kLp.1fIBCxQFEhUUvnfBy/GtCpa3nW',
			'type' => 'user',
            'email_verified_at' => Carbon::now()
		]);

        User::create([
            //Name, email, password, type
            'name' => 'Alex Legard',
            'email' => 'alexlegard3@yahoo.com',
            'password' => '$2y$10$WYeJA/7N1No2u0rdPJ7h4e6IKIOzCBVb0e89O/uE0khKw0pDX2cha',
            'type' => 'user',
            'email_verified_at' => Carbon::now()
        ]);
    }
}
