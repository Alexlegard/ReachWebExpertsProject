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
            'password' => \Hash::make('password'),
            'type' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            //Name, email, password, type
            'name' => 'Alex Legard',
            'email' => 'alexlegard3@yahoo.com',
            'password' => \Hash::make('password'),
            'type' => 'user',
            'email_verified_at' => Carbon::now()
        ]);
    }
}
