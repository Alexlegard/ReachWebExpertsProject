<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Review;

class ReviewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Review::create([
			'user_id'        => '1',
			'restaurant_id'  => '1',
			'content'        => 'This is an excellent restaurant.',
            'rating'         => 3,
			'time_submitted' => '2020-07-17'
		]);
    }
}
