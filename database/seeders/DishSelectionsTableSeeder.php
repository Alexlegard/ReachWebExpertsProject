<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\DishSelection;

class DishSelectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishSelection::create([
            'dish_id' => 1,
            'name' => 'Bread',
            'options' => ["Italian","Italian Herbs & Cheese","9-Grain Honey Oat","9-Grain Wheat"],
            'radio_or_checkbox' => 'radio'
        ]);
    }
}
