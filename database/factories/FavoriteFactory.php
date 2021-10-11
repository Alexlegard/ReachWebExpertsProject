<?php

namespace Database\Factories;

use App\Favorite;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class FavoriteFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Favorite::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'restaurant_id' => 1
        ];
    }
}
