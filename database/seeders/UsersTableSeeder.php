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
            'password' => '$2y$10$qDsvuA4OPejyJqBXFzAcXuhp1fc1bABTvoIuH9ytXyFlor.GgcBRe',
            'type' => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            //Name, email, password, type
            'name' => 'Alex Legard',
            'email' => 'alexlegard3@yahoo.com',
            'password' => '$2y$10$scQLx4JzZljwe95/n36cbu4aMmmDc47xNNU5PSaKz43gu6ymI0h4O',
            'type' => 'user',
            'email_verified_at' => Carbon::now()
        ]);
    }
}
