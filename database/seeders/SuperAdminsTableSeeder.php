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
            'name' => 'Alex Legard',
            'email' => 'alexlegard3@gmail.com',
            'password' => '$2y$10$HNdxRVWVF2t2g3d7NERB8.GP77jcfDLod90/vymeEba5jpvRwSKvC',
        ]);
    }
}
