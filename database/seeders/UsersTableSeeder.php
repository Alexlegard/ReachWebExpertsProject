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
    }
}
