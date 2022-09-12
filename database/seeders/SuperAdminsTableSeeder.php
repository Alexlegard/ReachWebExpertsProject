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
            'name'     => 'Alex Legard',
            'email'    => env('EMAIL_SEED'),
            'password' => \Hash::make('>UGDdFi?w2ur'),
        ]);
    }
}
