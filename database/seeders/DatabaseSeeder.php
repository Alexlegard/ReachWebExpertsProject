<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
		$this->call([
			UsersTableSeeder::class,
			AdminsTableSeeder::class,
			SuperAdminsTableSeeder::class,
			RestaurantsTableSeeder::class,
			DishesTableSeeder::class,
			AdminRestaurantTableSeeder::class,
			OrdersTableSeeder::class,
			RestaurantApplicationsTableSeeder::class,
			ReviewsTableSeeder::class,
			FavoritesTableSeeder::class,
			CouponsTableSeeder::class,
			ProfilesTableSeeder::class,
			DishSelectionsTableSeeder::class,
		]);
    }
}
