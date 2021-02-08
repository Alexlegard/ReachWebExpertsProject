<?php

use Illuminate\Database\Seeder;
use App\Restaurant;

class RestaurantsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Restaurant::create([
			'name'               => 'Subway',
			'description'        => 'Eat fresh with our wide selection of sandwiches.',
			'slug'               => 'slug',
			'address'            => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine'            => ["Sandwiches",null,null],
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/subway.jpeg',
			'facebook'           => 'https://www.facebook.com/subway/',
			'twitter'            => 'https://twitter.com/SUBWAY',
			'instagram'          => 'https://www.instagram.com/subway/'
		]);
		
		Restaurant::create([
			'name' => 'McDonalds',
			'description' => 'Your favorite burgers, fries & more',
			'slug' => 'slug',
			'address' => json_decode('{"streetaddress":"45 Mountainash Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine' => ["Sandwiches","Fries","Coffee"],
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/mcdonalds.png',
			'facebook'           => 'https://www.facebook.com/McDonalds/',
			'twitter'            => 'https://twitter.com/mcdonalds',
			'instagram'          => 'https://www.instagram.com/mcdonalds/'
		]);
		
		Restaurant::create([
			'name' => 'Tim Hortons',
			'description' => "Home of Canada's favourite coffee.",
			'slug' => 'slug',
			'address' => json_decode('{"streetaddress":"43 Mountainash Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine' => ["Coffee","Sandwiches","Donuts"],
			'image_external_url' => 'http://alexlegard.ca/pictures/RWE_Project/timhortons.png',
			'facebook'           => 'https://www.facebook.com/TimHortons/',
			'twitter'            => 'https://twitter.com/TimHortons',
			'instagram'          => 'https://www.instagram.com/timhortons/'
		]);
    }
}
