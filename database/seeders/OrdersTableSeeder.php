<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Order;

class OrdersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $order = Order::create([
			'user_id' => '1',
			'billing_email' => 'alexlegard3@gmail.com',
			'billing_name' => 'Alex Legard',
			'billing_streetaddress' => '10 Panda Lane',
			'billing_city' => 'Brampton',
			'billing_state_province' => 'Ontario',
			'billing_country' => 'Canada',
			'billing_postalcode' => 'q4q4q4',
			'billing_name_on_card' => 'Alex Legard',
			'billing_subtotal' => '10.97',
			'billing_subtotal_after_discount' => '10.97',
			'billing_tax' => '1.42',
			'billing_total' => '12.39',
			'billing_commission' => '2.48',
			'payment_gateway' => 'Stripe',
			'shipped' => false,
			'time_placed' => '2020-07-13',
		]);
		
		$order->dishes()->sync( array( 
			1 => array( 'order_id' => 1, 'dish_id' => 1, 'quantity' => 1 )
		));
    }
}