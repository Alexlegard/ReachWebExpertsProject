<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\DishInvoice;

class DishInvoiceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DishInvoice::create([
            'invoice_id' => 1,
            'dish_id'    => 1,
            'quantity'   => 1
        ]);
    }
}
