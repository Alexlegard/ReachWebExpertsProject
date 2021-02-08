<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\RestaurantApplication;
use Faker\Generator as Faker;

$factory->define(RestaurantApplication::class, function (Faker $faker) {
    return [
        'admin_id' => 1,
		'name' => $faker->company,
		'description' => $faker->paragraph,
		'slug' => 'slug',
		'address' => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
		'cuisine' => ["Sandwiches",null,null],
    ];
});