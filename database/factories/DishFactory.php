<?php

namespace Database\Factories;

use App\Dish;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class DishFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Dish::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'menu_id' => 1,
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'slug' => 'slug',
            'price' => json_decode('{"currency":"CAD","amount":"7.99"}'),
            'special_price' => json_decode('{"currency":"CAD","amount":"5.99"}'),
            'cuisine' => $this->faker->word(),
            'calories' => $this->faker->randomNumber(3),
            'people_served' => 1,
            'stock' => $this->faker->randomNumber(3),
            'is_beverage' => false,
            'is_alcoholic' => false
        ];
    }
}
