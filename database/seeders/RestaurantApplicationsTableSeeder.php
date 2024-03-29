<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\RestaurantApplication;

class RestaurantApplicationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        RestaurantApplication::create([
			'admin_id' => 1,
			'name' => 'Mr. Sub',
			'description' => 'We have even fresher sandwiches.',
			'slug' => 'mr-sub-bovaird-st',
			'address' => json_decode('{"streetaddress":"8888 Bovaird St East","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine' => ["Sandwiches",null,null],
			'image' => 'db-seed-do-not-delete.png'
		]);
    }
}
