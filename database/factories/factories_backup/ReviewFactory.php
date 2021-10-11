<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Review;
use Faker\Generator as Faker;

$factory->define(Review::class, function (Faker $faker) {
    return [
        'user_id'        => '1',
		'restaurant_id'  => '1',
		'rating'         => '4',
		'content'        => $faker->paragraph,
		'time_submitted' => now()
    ];
});
