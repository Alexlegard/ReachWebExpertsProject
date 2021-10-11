<?php

namespace Database\Factories;

use App\Order;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'                         => '1',
            'billing_email'                   => $this->faker->email(),
            'billing_name'                    => $this->faker->name(),
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
            'time_placed'                     => $this->faker->dateTimeThisMonth(),
        ];
    }
}
