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
            'name'              => 'Alex Legard',
            'email'             => env('EMAIL_SEED'),
            'password'          => \Hash::make('HyLEy}6Ri-ff'),
            'type'              => 'user',
            'email_verified_at' => Carbon::now()
        ]);

        User::create([
            //Name, email, password, type
            'name'              => 'Alex Legard',
            'email'             => env('EMAIL_SEED_TWO'),
            'password'          => \Hash::make('3_gQWu:mB_!c'),
            'type'              => 'user',
            'email_verified_at' => Carbon::now()
        ]);
    }
}
