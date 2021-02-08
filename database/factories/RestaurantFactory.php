<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Restaurant;
use Faker\Generator as Faker;
use Illuminate\Support\Str;



$factory->define(Restaurant::class, function (Faker $faker) {
    return [
        // Name, description, slug, address, cuisine, 
		'name'               => $faker->company,
		'description'        => $faker->sentence,
		'slug'               => 'slug',
		'address'            => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
		'cuisine'            => $cuisine = ["Sandwiches",null,null],
    ];
});
