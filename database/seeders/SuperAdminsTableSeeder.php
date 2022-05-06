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
            'password' => '$2y$10$8oWsL7TppnVsTpIS3xF13.1FNUy4fFh060qiejftFgO7AGkd1MQwi',
        ]);
    }
}
