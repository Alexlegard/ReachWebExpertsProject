<?php

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
			'slug' => 'slug',
			'address' => json_decode('{"streetaddress":"8888 Bovaird St East","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine' => ["Sandwiches",null,null]
		]);
    }
}
