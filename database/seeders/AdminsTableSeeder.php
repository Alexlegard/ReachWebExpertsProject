<?php

namespace Database\Seeders;

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
            'name'     => 'Alex Legard',
            'email'    => 'alexlegard3@gmail.com',
            'password' => \Hash::make('password'),
        ]);
    }
}
