<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Favorite;

class FavoritesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Favorite::create([
			'user_id' => 1,
			'restaurant_id' => 1
		]);
    }
}
