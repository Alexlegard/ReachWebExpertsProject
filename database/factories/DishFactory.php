<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Dish;
use Faker\Generator as Faker;

$factory->define(Dish::class, function (Faker $faker) {
    return [
        'menu_id' => 1,
		'name' => $faker->word,
		'description' => $faker->paragraph,
		'slug' => 'slug',
		'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
		'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
		'cuisine' => $faker->word,
		'calories' => $faker->randomNumber(3),
		'people_served' => 1,
		'stock' => $faker->randomNumber(3),
		'is_beverage' => false,
		'is_alcoholic' => false
    ];
});