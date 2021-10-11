<?php

namespace Database\Factories;

use App\Review;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ReviewFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Review::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id'        => '1',
            'restaurant_id'  => '1',
            'rating'         => '4',
            'content'        => $this->faker->paragraph(),
            'time_submitted' => now()
        ];
    }
}
