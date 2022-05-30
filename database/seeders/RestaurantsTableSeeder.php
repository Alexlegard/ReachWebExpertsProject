<?php

namespace Database\Seeders;

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
			'slug'               => 'subway-mcvean-dr',
			'address'            => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine'            => ["Sandwiches",null,null],
			'image'              => 'subway.png',
			'facebook'           => 'https://www.facebook.com/subway/',
			'twitter'            => 'https://twitter.com/SUBWAY',
			'instagram'          => 'https://www.instagram.com/subway/'
		]);
		
		Restaurant::create([
			'name'               => 'McDonalds',
			'description'        => 'Your favorite burgers, fries & more',
			'slug'               => 'mcdonalds-mountainash-rd',
			'address'            => json_decode('{"streetaddress":"45 Mountainash Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine'            => ["Sandwiches","Fries","Coffee"],
			'image'              => 'mcdonalds.png',
			'facebook'           => 'https://www.facebook.com/McDonalds/',
			'twitter'            => 'https://twitter.com/mcdonalds',
			'instagram'          => 'https://www.instagram.com/mcdonalds/'
		]);
		
		Restaurant::create([
			'name'               => 'Tim Hortons',
			'description'        => "Home of Canada's favourite coffee.",
			'slug'               => 'tim-hortons-mountainash-rd',
			'address'            => json_decode('{"streetaddress":"43 Mountainash Rd","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
			'cuisine'            => ["Coffee","Sandwiches","Donuts"],
			'image'              => 'timhortons.png',
			'facebook'           => 'https://www.facebook.com/TimHortons/',
			'twitter'            => 'https://twitter.com/TimHortons',
			'instagram'          => 'https://www.instagram.com/timhortons/'
		]);
    }
}
