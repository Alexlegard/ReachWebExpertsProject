<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_id'                         => '1',
		'billing_email'                   => $faker->email,
		'billing_name'                    => $faker->name,
		'billing_streetaddress'           => '10 Panda Lane',
		'billing_city'                    => 'Brampton',
		'billing_state_province'          => 'Ontario',
		'billing_country'                 => 'Canada',
		'billing_postalcode'              => 'q4q4q4',
		'billing_name_on_card'            => 'Alex Legard',
		'billing_subtotal'                => '10.97',
		'billing_subtotal_after_discount' => '10.97',
		'billing_tax'                     => '1.42',
		'billing_total'                   => '12.39',
		'billing_commission'              => '2.48',
		'payment_gateway'                 => 'Stripe',
		'shipped'                         => false,
		'time_placed'                     => $faker->dateTimeThisMonth,
    ];
	
	
});
/*
$factory->afterCreating(App\User::class, function ($order, $faker) {
    $order->dishes()->sync( array( 
		1 => array( 'order_id' => $order->id, 'dish_id' => 1, 'quantity' => 1 )
	));
});*/