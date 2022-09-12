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
            'email'    => env('EMAIL_SEED'),
            'password' => \Hash::make('v11gH,^!w}-H'),
        ]);
    }
}
