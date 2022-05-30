<?php

namespace Database\Factories;

use App\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->company();

        return [
            'name'               => $name,
            'description'        => $this->faker->sentence(),
            'slug'               => $name,
            'address'            => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine'            => $cuisine = ["Sandwiches",null,null],
        ];
    }
}
