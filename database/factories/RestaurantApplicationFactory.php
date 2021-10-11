<?php

namespace Database\Factories;

use App\RestaurantApplication;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RestaurantApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = RestaurantApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_id' => 1,
            'name' => $this->faker->company(),
            'description' => $this->faker->paragraph(),
            'slug' => 'slug',
            'address' => json_decode('{"streetaddress":"9995 McVean Dr","city":"Brampton","stateprovince":"Ontario","country":"Canada"}'),
            'cuisine' => ["Sandwiches",null,null],
        ];
    }
}
