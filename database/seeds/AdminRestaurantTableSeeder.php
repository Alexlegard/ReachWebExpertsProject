<?php

use Illuminate\Database\Seeder;
use App\AdminRestaurant;

class AdminRestaurantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AdminRestaurant::create([
			//admin_id, restaurant_id
			'admin_id' => '1',
			'restaurant_id' => '1'
		]);
    }
}
